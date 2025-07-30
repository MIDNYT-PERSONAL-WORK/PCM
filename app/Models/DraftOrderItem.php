<?php

namespace App\Models;

use App\Models\Product;
use App\Models\DraftOrder;
use Illuminate\Database\Eloquent\Model;

class DraftOrderItem extends Model
{
    // use HasFactory;

    protected $fillable = [
        'draft_order_id',
        'product_id',
        'delivery_fee',
        'quantity',
        'price',
        'amount'
    ];

    public function draftOrder()
    {
        return $this->belongsTo(DraftOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
