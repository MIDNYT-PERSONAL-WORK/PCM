<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        // You can add logic here to fetch data for the admin dashboard
        // For example, fetching total users, orders, vendors, etc.
        $TotalOrder=Order::count();
        $TotalRider=User::where('role','rider')->where('is_active','active')->count();
        $TotalVendor=User::where('role','vendor')->where('is_active','active')->count();
        return view('admin.dashboard',compact('TotalOrder','TotalRider','TotalVendor'));
    }
}
