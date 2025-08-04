<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
       'order_number',
        'customer_name',
        'subtotal',
        'phone',
        'product_id',
        'quantity',
        'amount',
        'delivery_fee',
        'location',
        'city',
        'source',
        'payment_mode',
        'status',
        'operator_id',
        'rider_id',
        'delivery_code'
    ];



    public function product() {
        return $this->belongsTo(Product::class);
    }

     public function items()
    {
        return $this->hasMany(DraftOrderItem::class);
    }

    public function operator() {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function rider() {
        return $this->belongsTo(User::class, 'rider_id');
    }
    public function vendor() {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function OrderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

}
