<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('guest.welcome');
});

Route::view('auth','auth.LoginSignup')->name('LoginSignup');

Route::Post('login',[AuthController::class, 'login'])->name('login');
Route::view('admin/orders', 'admin.order')->name('admin.order');
Route::view('admin/inventory', 'admin.inventory')->name('admin.inventory');
Route::view('admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
Route::view('admin/vendors', 'admin.vendor')->name('admin.vendor');
Route::view('admin/customers', 'admin.customer')->name('admin.customer');
Route::view('vendor/dashboard', 'vendor.dashboard')->name('vendor.dashboard');
Route::view('operator/dashboard', 'operator.dashboard')->name('operator.dashboard');
Route::view('rider/dashboard', 'rider.dashboard')->name('rider.dashboard');