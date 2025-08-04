<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'vendor_id',
        'name',
        'slug',
        'description',
        'price',
        'compare_price',

        'sku',
        'category_id',
        'stock',

        'weight',
        'images',


    
    ];


    public function vendor() {
    return $this->belongsTo(User::class );
}

    public function orders() {
        return $this->hasMany(Order::class);
    }
    

}
