<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Events\RiderLocationUpdated;

class RiderController extends Controller
{
    //
    public function dashboard()
    {
        //dd('Welcome to the Rider Dashboard', auth()->user());
        $today = now()->format('Y-m-d'); // Get current date in YYYY-MM-DD format

        $totalTodayDelivery = Order::where('rider_id', auth()->id())
            ->where('status', 'confirmed')
            ->whereDate('created_at', $today) // Filter by today's date
            ->count();

        $deliveries = Order::with([ 'OrderItems.product.vendor', 'operator'])
            ->where('rider_id', auth()->id())
            ->where('status', 'confirmed')
            ->whereDate('created_at', $today)
            ->get();
       
        return view('rider.dashboard', compact('totalTodayDelivery', 'deliveries'));
    }
    public function delivery(Request $request)
    {
        // Get the authenticated rider's ID
        $riderId = auth()->id();

        // Initialize query
        $query = Order::with(['orderItems.product.vendor', 'operator'])
            ->where('rider_id', $riderId);

        // Search filter (order_number or customer_name)
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }

        // Status filter
        $status = $request->input('status', 'all');
        if ($status !== 'all') {
            $query->where('status', $status);
        } else {
            $query->whereIn('status', ['pending', 'in-progress', 'confirmed', 'completed']);
        }

        // Sort options
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'amount-high':
                $query->orderBy('amount', 'desc');
                break;
            case 'amount-low':
                $query->orderBy('amount', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Paginate results
        $deliveries = $query->paginate(10);

        // Map deliveries for view
        $deliveries->getCollection()->transform(function ($order) {
            // Assume pickup is from vendor's address (via orderItems.product.vendor)
            $pickup = $order->orderItems->first()
                ? ($order->orderItems->first()->product->vendor->name ?? 'N/A') . ', ' . ($order->orderItems->first()->product->vendor->address ?? $order->location)
                : 'N/A';

            // Assume delivery is from order's location or city
            $delivery = ($order->customer_name ?? 'N/A') . ', ' . ($order->location ?? $order->city);

            // Map status to view-friendly format
            $statusMap = [
                'confirmed' => 'In Progress',
                'pending' => 'Pending',
                'in-progress' => 'In Progress',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ];

            return [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'customer_name' => $order->customer_name,
                'phone' => $order->phone,
                'pickup' => $pickup,
                'delivery' => $delivery,
                'status' => $statusMap[$order->status] ?? $order->status,
                'amount' => 'GH₵' . number_format($order->amount, 2),
                'created_at' => $order->created_at->format('M d, Y, h:i A'),
                'action' => $order->status === 'pending' ? 'Start' : ($order->status === 'in-progress' || $order->status === 'confirmed' ? 'Complete' : 'Details'),
                'navigate' => in_array($order->status, ['pending', 'in-progress', 'confirmed']),
            ];
        });
        return view('rider.delivery', compact('deliveries'));
    }
    public function payment()
    {
        return view('rider.payments');
    }
    public function performance()
    {
        return view('rider.performance');
    }

 



    public function status(Request $request)
{
    if (!auth()->check()) {
        Log::warning('Unauthorized attempt to update rider status', [
            'ip' => $request->ip(),
            'input' => $request->all()
        ]);
        return response()->json(['error' => 'You must be logged in to change your status.'], 401);
    }

    $request->validate([
        'status' => 'required|in:online,offline',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric'
    ]);

    $user = auth()->user();
    $user->is_active = $request->input('status') === 'online' ? 'active' : 'inactive';

    // Load the current order with relationships
    $currentOrder = Order::where('rider_id', $user->id)
        ->where('status', 'confirmed')
        ->with(['orderItems.product.vendor', 'operator'])
        ->first();

    // Log the incoming status and location data
    Log::info('Rider status update received', [
        'user_id' => $user->id,
        'status' => $request->status,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'order_id' => $currentOrder->id ?? 'none'
    ]);

    // Update location if provided
    if ($request->has(['latitude', 'longitude'])) {
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
    }

    try {
        $user->save();
    } catch (\Exception $e) {
        Log::error('Failed to update rider status', [
            'error' => $e->getMessage(),
            'user_id' => $user->id,
            'input' => $request->all()
        ]);
        return response()->json(['error' => 'Failed to update status'], 500);
    }

    // Broadcast location if going online
    if ($request->status === 'online' && $request->has(['latitude', 'longitude']) && $currentOrder) {
        event(new RiderLocationUpdated(
            $currentOrder->id,
            $request->latitude,
            $request->longitude
        ));
        Log::info('RiderLocationUpdated event fired', [
            'order_id' => $currentOrder->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
    } else {
        Log::warning('RiderLocationUpdated event not fired', [
            'reason' => $request->status !== 'online' ? 'Status not online' : 
                       (!$request->has(['latitude', 'longitude']) ? 'Missing location' : 'No current order'),
            'user_id' => $user->id
        ]);
    }

    return response()->json([
        'success' => true,
        'message' => 'Status updated to ' . $request->status,
        'status' => $request->status,
        'current_order' => $currentOrder,
        'location' => $request->has(['latitude', 'longitude']) ? [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ] : null
    ]);
}
}
    

