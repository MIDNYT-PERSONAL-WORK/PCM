<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\DraftOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    //index operatir page

    public function index(){
       
        return view('operator.dashboard');
    }

    public function assignRider(DraftOrder $draft){
        $riderId = request('rider_id'); // Assuming rider_id is passed in the request
        $draft->update(['rider_id' => $riderId]);

        // Additional logic for assigning rider if needed

        return back()->with('success', 'Rider assigned successfully');
    }

    public function setDeliveryFee(Request $request, DraftOrder $draft)
{
    //dd($draft);
    $validated = $request->validate([
        'delivery_fee' => 'required|numeric|min:0'
    ]);
    // dd($validated,$draft);
    $draft->items()->each(function ($item) use ($validated) {
        $item->update(['delivery_fee' => $validated['delivery_fee']]);
    });
     //update price
    $draft->update(['amount' => $validated['delivery_fee'] + $draft->items->sum('amount')]);
    return back()->with('success', 'Delivery fee updated');
}


    
    public function confirmOrder(Order $order)
{
    $order->update(['status' => 'confirmed']);

    $customerPhone = $order->phone;
    $deliveryCode = $order->delivery_code;

    // Using eager loaded relationship with proper chaining
    $items = $order->orderItems->map(function($orderItem) {
        return $orderItem->product->name ?? 'Unknown Product';
    })->implode(', ');

    // OR using pluck() with proper relationship nesting
    $items = $order->orderItems->pluck('product.name')->filter()->implode(', ');
    //dd($items);    
    // Generate tracking URL
    $trackingUrl = route('tracking.show', ['order' => $order->id, 'code' => $deliveryCode]);
    
    $message = "Your order has been confirmed! Items: {$items}. Total: GHC{$order->amount}. Delivery Code: {$deliveryCode}. Track your delivery: {$trackingUrl}";

    $smsSent = $this->sendDeliveryNotification($customerPhone, $message);

    if (!$smsSent) {
        return back()->with('error', 'Order confirmed but failed to send notification');
    }

    return back()->with('success', 'Order confirmed successfully');
}


protected function sendDeliveryNotification($phone, $message)
{
    $apiKey = 'cVBnckhteVpqb1VaZVZTbXNVcGM'; // Your Arkesel API key
    $senderId = 'PCM'; // Your approved sender ID
    
    $response = Http::get('https://sms.arkesel.com/sms/api', [
        'action' => 'send-sms',
        'api_key' => $apiKey,
        'to' => '233' . ltrim($phone, '0'), // Format: 233XXXXXXXXX
        'from' => $senderId,
        'sms' => $message
    ]);

    $responseData = $response->json();

    if ($response->successful() && ($responseData['code'] ?? '') === 'ok') {
        Log::info("SMS sent to {$phone} via Arkesel", [
            'balance' => $responseData['balance'] ?? null,
            'sms_id' => $responseData['sms_id'] ?? null
        ]);
        return true;

    }

    Log::error("Arkesel SMS failed to {$phone}", [
        'status' => $response->status(),
        'response' => $responseData,
        'formatted_number' => '233' . ltrim($phone, '0')
    ]);
    return false;
}





    public function confirm(DraftOrder $draft)
{
    DB::beginTransaction(); // Start transaction for data consistency

    try {
        $draft->load(['items.product.vendor', 'rider']);
        
        $draft->update([
            'status' => 'processing',
            'rider_id' => request('rider_id'),
        ]);

        // Calculate totals
        $subtotal = $draft->items->sum('amount');
        $deliveryFee = $draft->items->first()->delivery_fee ?? request('delivery_fee');
        $totalAmount = $subtotal + $deliveryFee;
        //dd($subtotal, $deliveryFee, $totalAmount);                              
        // Create the order
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'customer_name' => $draft->customer_name,
            'phone' => $draft->phone,
            'location' => $draft->location,
            'city' => $draft->city,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'amount' => $totalAmount,
            'status' => 'confirmed',
            'operator_id' => auth()->user()->id,
            'rider_id' => $draft->rider_id,
            'delivery_code' => 'DEL-' . strtoupper(uniqid()),
        ]);

        // Process each item
        foreach ($draft->items as $draftItem) {
            // Create order item
            $order->OrderItems()->create([
                'product_id' => $draftItem->product_id,
                'quantity' => $draftItem->quantity,
                'price' => $draftItem->price,
                'amount' => $draftItem->amount,
            ]);

            // Deduct from product stock
            $product = $draftItem->product;
            $newStock = $product->stock - $draftItem->quantity;
            
            if ($newStock < 0) {
                throw new \Exception("Insufficient stock for product: {$product->name}");
            }

            $product->update(['stock' => $newStock]);

            // Deduct from inventory
            $inventory = Inventory::where('product_id', $product->id)
                ->where('vendor_id', $product->vendor_id)
                ->first();

            if ($inventory) {
                $newAvailable = $inventory->quantity_available - $draftItem->quantity;
                
                if ($newAvailable < 0) {
                    throw new \Exception("Insufficient inventory for product: {$product->name}");
                }

                $inventory->update([
                    'quantity_available' => $newAvailable,
                    'status' => ($newAvailable > 0) ? 'in_stock' : 'out_of_stock'
                ]);
            }
        }

        DB::commit(); // Commit all changes if everything succeeds
        return back()->with('success', 'Order confirmed successfully');

    } catch (\Exception $e) {
        DB::rollBack(); // Rollback all changes if any error occurs
        return back()->with('error', 'Order confirmation failed: ' . $e->getMessage());
    }
}

    public function save(DraftOrder $draft)
    {
        dd($draft);
        $draft->update(['status' => 'draft']);
        // Additional save logic
        
        return back()->with('success', 'Draft saved successfully');
    }

    public function cancel(DraftOrder $draft)
    {
        $draft->delete();
        // Additional cancellation logic
        
        return redirect()->route('drafts.index')->with('success', 'Order cancelled successfully');
    }




    public function draft(){
        $TotalDraft=DraftOrder::count();
        $totalToday = DraftOrder::whereDate('created_at', today())->count();
        $olderThan3Days = DraftOrder::where('created_at', '<', now()->subDays(3)) ->count();
        // Calculate average hours drafts remain in 'draft' status
        $avgDraftAgeHours = DB::table('draft_orders')
            ->where('status', 'draft')
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, NOW())) as avg_age_hours')
            ->first()
            ->avg_age_hours;
        $AllDrafts = DraftOrder::with(['items.product'])
            ->paginate(10);

        // dd($AllDraft);
        return view('operator.draft',compact('TotalDraft','totalToday','olderThan3Days','avgDraftAgeHours','AllDrafts'));
    }

      public function order(){
        $TotalOrders = DraftOrder::count();
        $totalToday = DraftOrder::whereDate('created_at', today())->count();
        $olderThan3Days = DraftOrder::where('created_at', '<', now()->subDays(3))->count();
        $avgProcessingTime = DB::table('draft_orders')
        ->where('status', 'completed')
        ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_processing_hours')
        ->first()
        ->avg_processing_hours;
        //will 
        $vendorName=user::
            where('id', auth()->user()->id)
            ->pluck('name')
            ->first();
        //dd($vendorName);
        $AllOrders = Order::with(['vendor', 'operator','OrderItems'])
            ->paginate(10);
        //dd($AllOrders);
        // Calculate average hours orders remain in 'draft' status
        return view('operator.order', compact('TotalOrders', 'totalToday', 'olderThan3Days', 'avgProcessingTime', 'AllOrders', 'vendorName'));
    }

    // In DraftController.php
    public function edit(DraftOrder $draft)
{
    $draft->load(['items.product.vendor', 'rider']);
    $riders = User::where('role', 'rider')->orderBy('name')->get();
   // dd($draft);
    return view('operator.detail', compact('draft', 'riders'));
}

    public function dispatch()
    {
        $drafts = DraftOrder::with(['items.product.vendor', 'rider'])
            ->where('status', 'draft')
            ->paginate(10);
        return view('operator.dispatch', compact('drafts'));
    }

    public function OperatorRiders()
    {
        $riders = User::where('role', 'rider')->orderBy('name')->get();
        return view('operator.riders', compact('riders'));
    }

    public function OperatorPayments()
    {
        // Logic for operator payments
        return view('operator.payments');
    }

    
}
