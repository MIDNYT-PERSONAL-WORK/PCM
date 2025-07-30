<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
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
    $order->update(['status' => 'delivered']);

    $customerPhone = $order->phone;
    //send things order  with price and delivery code
    $deliveryCode = $order->delivery_code;
    //list of things bought
    $items = $order->product->pluck('name')->toArray();
    // dd($items);
    $items = implode(', ', $items);
    $message = "Your order has been confirmed! Items: {$items}. Total: GHC{$order->amount}. Delivery Code: {$deliveryCode}";
   
    
    


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
       // dd($draft, request('rider_id'));
       $draft->load(['items.product.vendor', 'rider']);
        $draft->update([
            'status' => 'processing',
            'rider_id' => request('rider_id'), // Assuming rider_id is passed in the request
            
        ]);
        //dd($draft);
        //create a delivery code

        //move to order
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'customer_name' => $draft->customer_name,
            'phone' => $draft->phone,
            'product_id' => $draft->items->first()->product_id,
            'quantity' => $draft->items->sum('quantity'),
            'amount' => $draft->items->sum('amount') + $draft->amount,
            'delivery_fee' => $draft->items->first()->delivery_fee,
            'location' => $draft->location,
            'city' => $draft->location,
            //'source' => $draft->source,
            //'payment_mode' => $draft->payment_mode,
            'status' => 'confirmed',
            'operator_id' => $draft->user_id,
            'rider_id' => $draft->rider_id,
            'delivery_code' =>  'DEL-' . strtoupper(uniqid()),
        ]);
        $order->save();
        // Additional confirmation logic
        
        return back()->with('success', 'Order confirmed successfully');
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
        $AllOrders = Order::with(['product.vendor', 'operator'])
            ->paginate(10);
        //dd($AllOrders);
        // Calculate average hours orders remain in 'draft' status
        return view('operator.order', compact('TotalOrders', 'totalToday', 'olderThan3Days', 'avgProcessingTime', 'AllOrders'));
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
