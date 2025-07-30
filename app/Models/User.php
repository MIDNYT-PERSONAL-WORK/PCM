<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Log;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Documents;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'is_active',
    
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function products() {
    return $this->hasMany(Product::class, 'vendor_id');
    }

    public function operatorOrders() {
        return $this->hasMany(Order::class, 'operator_id');
    }

    public function riderOrders() {
        return $this->hasMany(Order::class, 'rider_id');
    }

    public function vendorProfile() {
        return $this->hasOne(Vendor::class);
    }

    public function Log() {
        return $this->hasMany(Log::class);
    }


    public function documents()
    {
        return $this->hasMany(Documents::class);
    }

    //  public function vendorProfile()
    // {
    //     return $this->hasOne(Vendor::class);
    // }

    public function vendorReviews()
    {
        return $this->hasMany(VendorReview::class, 'vendor_id');
    }

    public function vendorPayments()
    {
        return $this->hasMany(VendorPayment::class, 'vendor_id');
    }

    public function vendorPayouts()
    {
        return $this->hasMany(VendorPayout::class, 'vendor_id');
    }

    public function vendorNotifications()
    {
        return $this->hasMany(VendorNotification::class, 'vendor_id');
    }

    public function vendor() {
    return $this->hasOne(Vendor::class);
}

}
