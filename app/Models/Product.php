<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    public function vendor() {
    return $this->belongsTo(User::class, 'vendor_id');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

}
