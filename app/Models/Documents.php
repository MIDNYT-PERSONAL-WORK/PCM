<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    //
    protected $fillable = [
        'user_id',
        'government_id',
        'proof_of_address',
        'vehicle_registration',
        'business_license',
        'insurance_certificate',
        'additional_documents',
        'terms',
        'privacy'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
