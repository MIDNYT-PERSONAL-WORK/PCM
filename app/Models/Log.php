<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $fillable = [
        'user_id', 
        'activity', 
        'ip_address', 
        'status', 
        'details'
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
