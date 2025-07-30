<?php

namespace App\Models;

use App\Models\Order;
use App\Models\DraftOrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DraftOrder extends Model
{
    //
     use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'session_id',
        'rider_id',
        'customer_name',
        'phone',
        'location',
        'city',
        'status',
        'notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rider()
{
    return $this->belongsTo(User::class, 'rider_id')->where('role', 'rider');
}

    public function items()
    {
        return $this->hasMany(DraftOrderItem::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function calculateTotal()
    {
        return $this->items->sum('amount');
    }
}
