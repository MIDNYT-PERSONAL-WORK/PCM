<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $fillable = [
        'product_id',
        'vendor_id',
        'quantity_received',
        'quantity_available',
        'status',
        


    
    ];

    public function product() {
    return $this->belongsTo(Product::class);
    }

    public function vendor() {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    

}
