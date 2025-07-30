<?php

namespace App\Models;

use App\Models\User;
use App\Models\VendorPayout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'bank_name',
        'account_name',
        'account_number',
        'routing_number',
        'swift_code',
        'iban',
        'is_primary'
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function payouts()
    {
        return $this->hasMany(VendorPayout::class, 'payment_method_id');
    }
}