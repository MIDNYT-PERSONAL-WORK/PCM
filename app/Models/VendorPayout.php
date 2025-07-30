<?php

namespace App\Models;

use App\Models\User;
use App\Models\VendorPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorPayout extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'payment_method_id',
        'amount',
        'fee',
        'status',
        'reference',
        'failure_reason',
        'processed_at',
        'processed_by'
    ];

    protected $casts = [
        'processed_at' => 'datetime',
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(VendorPayment::class, 'payment_method_id');
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}