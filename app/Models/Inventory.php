<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    public function product() {
    return $this->belongsTo(Product::class);
    }

    public function vendor() {
        return $this->belongsTo(User::class, 'vendor_id');
    }

}
