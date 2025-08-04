<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    //
    public function show(Order $order, $code)
{
    // Verify the delivery code matches
    if ($order->delivery_code !== $code) {
        abort(404);
    }

    return view('guest.tracking', [
        'order' => $order,
        'rider' => $order->rider,
        'customer' => $order->customer_name,
        'deliveryCode' => $code,
        'deliveries' => collect([$order]) // Wrap the single order in a collection
    ]);
}
}
