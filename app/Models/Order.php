<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function product() {
    return $this->belongsTo(Product::class);
    }

    public function operator() {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function rider() {
        return $this->belongsTo(User::class, 'rider_id');
    }

}
