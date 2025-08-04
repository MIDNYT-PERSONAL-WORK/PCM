<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
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
    public function delivery()
    {
        return view('rider.delivery');
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
        return response()->json(['error' => 'You must be logged in to change your status.'], 401);
    }

    $request->validate([
        'status' => 'required|in:online,offline',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric'
    ]);

    $user = auth()->user();
    $user->is_active = $request->input('status') === 'online' ? 'active' : 'inactive';
    
    // Update location if provided
    if ($request->has(['latitude', 'longitude'])) {
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
    }
    
    $user->save();

    // Broadcast location if going online
    if ($request->status === 'online' && $request->has(['latitude', 'longitude'])) {
        event(new RiderLocationUpdated(
            $user->currentOrder->id ?? null,
            $request->latitude,
            $request->longitude
        ));
    }

    return response()->json([
        'success' => true,
        'message' => 'Status updated to ' . $request->status,
        'status' => $request->status
    ]);
}
    
}
