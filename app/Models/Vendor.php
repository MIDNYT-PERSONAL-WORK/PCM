<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Inventory;
use App\Models\VendorPayout;
use App\Models\VendorReview;
use App\Models\VendorPayment;
use App\Models\VendorNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'address',
        'status',
        'image'
    ];

    // In Vendor model
public function user()
{
    return $this->belongsTo(User::class);
}

    public function reviews()
    {
        return $this->hasMany(VendorReview::class);
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function paymentMethods()
    {
        return $this->hasMany(VendorPayment::class);
    }

    public function payouts()
    {
        return $this->hasMany(VendorPayout::class);
    }

    public function notifications()
    {
        return $this->hasMany(VendorNotification::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}