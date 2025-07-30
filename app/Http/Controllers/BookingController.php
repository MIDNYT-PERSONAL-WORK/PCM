<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\DraftOrder;
use Illuminate\Http\Request;
use App\Models\DraftOrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    //
     public function store(Request $request)
{
    // Debugging - remove in production
    // Log::debug('Checkout request data:', $request->all());
    
    // Validate the request
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20|regex:/^[0-9]+$/',
        'location' => 'required|string|max:500',
        'city' => 'required|string|max:100',
        'notes' => 'nullable|string|max:1000',
        'cart_items' => 'required|json',
        'subtotal' => 'required|numeric|min:0',
        'delivery_cost' => 'required|numeric|min:0',
        'total' => 'required|numeric|min:0',
    ]);
    //dd($validated);
    // Begin database transaction
    DB::beginTransaction();

    try {
        // Create the draft order
        $draftOrder = DraftOrder::create([
            'user_id' => Auth::id(),
            'session_id' => session()->getId(),
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'location' => $validated['location'],
            'city' => $validated['city'],
            'status' => 'pending_call',
            'notes' => $validated['notes'] ?? null,
            // 'subtotal' => $validated['subtotal'],
            // 'delivery_cost' => $validated['delivery_cost'],
            // 'total' => $validated['total'],
        ]);

        // Decode and validate cart items
        $cartItems = json_decode($validated['cart_items'], true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid cart items format');
        }

        // Add draft order items
        foreach ($cartItems as $item) {
            // Verify product exists and has sufficient stock
            $product = Product::findOrFail($item['id']);
            
            // Validate item structure
            if (!isset($item['quantity']) || !isset($item['price'])) {
                throw new \Exception('Invalid cart item structure');
            }

            // Validate quantity
            if ($item['quantity'] < 1) {
                throw new \Exception('Invalid quantity for product: ' . $product->name);
            }

            // Check stock availability if applicable
            if ($product->stock < $item['quantity']) {
                throw new \Exception('Insufficient stock for product: ' . $product->name);
            }

            DraftOrderItem::create([
                'draft_order_id' => $draftOrder->id,
                'product_id' => $item['id'],
                // 'product_name' => $product->name, // Store name in case product changes
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'amount' => $item['price'] * $item['quantity'],
                // 'image_url' => $item['image'] ?? null, // Store image reference
            ]);

            // Optionally reduce product stock here if you want to reserve it
            // $product->decrement('stock', $item['quantity']);
            // $product->save();
        }

        // Clear the cart from session
        // Before clearing
        Log::debug('Cart before clear:', $request->session()->get('cart') ?? []);

        // Clear the cart
        $request->session()->forget('cart');

        // After clearing
        Log::debug('Cart after clear:', $request->session()->get('cart') ?? []);

        // Verify session ID consistency
        Log::debug('Session ID:', [session()->getId()]);
        
        // Commit transaction
        DB::commit();

        // Send notifications (email, SMS, etc.)
        $this->sendOrderConfirmation($draftOrder);

        return redirect()->back()->with([
    'success' => 'Your order with id ' . $draftOrder->id . ' of  total ' . $draftOrder->total . ' has been received! Our team will call you shortly to confirm. Thank you for choosing us.',
    'clear_cart' => true
]);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        DB::rollBack();
        return back()->with('error', 'One of the products in your cart was not found. Please refresh your cart and try again.');
        
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Checkout error: ' . $e->getMessage());
        return back()->with('error', 'There was an error processing your order: ' . $e->getMessage());
    }
}

protected function sendOrderConfirmation(DraftOrder $order)
{
    // Implement your notification logic here
    // This could include:
    // 1. Email to customer
    // 2. Notification to admin/sales team
    // 3. SMS confirmation
}

    public function success(DraftOrder $draftOrder)
    {
        // Load the items with product information
        $draftOrder->load('items.product');
        
        return view('checkout.success', compact('draftOrder'));
    }
}
