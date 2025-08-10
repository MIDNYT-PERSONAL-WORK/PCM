<?php

use Illuminate\Http\Request;
use App\Events\RiderLocationUpdated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\InventoryController;









Route::get('/rider/dashboard', [RiderController::class, 'dashboard'])->name('rider.dashboard');
Route::get('/rider/delivery', [RiderController::class, 'delivery'])->name('rider.delivery');
Route::get('/rider/payment', [RiderController::class, 'payment'])->name('rider.payment');
Route::get('/rider/performance', [RiderController::class, 'performance'])->name('rider.performance');
Route::post('/rider/status', [RiderController::class, 'status'])->name('rider.status');
// routes/web.php
Route::get('/tracking/{order}/{code}', [TrackingController::class, 'show'])
    ->name('tracking.show');
Route::get('/vendor/dashboard/revenue-data', [VendorController::class, 'getRevenueData']); 
Route::get('/vendor/orders/{order}', [VendorController::class, 'show'])->name('vendor.orders.show');
Route::get('/vendor/analysic', [VendorController::class, 'analysic'])->name('vendor.analytic');
Route::get('/vendor/dashboard/chart-data', [VendorController::class, 'getChartData']);
// routes/api.php
Route::post('/rider/location', function (Request $request) {
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric'
    ]);

    // Update rider's location
    auth()->user()->update([
        'latitude' => $request->latitude,
        'longitude' => $request->longitude
    ]);

    // Broadcast update
    event(new RiderLocationUpdated(
        $request->order_id,
        $request->latitude,
        $request->longitude
    ));

    return response()->json(['success' => true]);
});










Route::get('/test-sms', [OrderController::class, 'testMNotifyConnection']);


Route::get('/', [AuthController::class, 'welcome'])->name('welcome');
Route::view('auth','auth.login')->name('LoginSignup');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::post('/checkout', [BookingController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{id}', [BookingController::class, 'success'])->name('checkout.success');

Route::put('/drafts/{draft}/confirm', [OrderController::class, 'confirm'])->name('draft.confirm');
Route::put('/drafts/{draft}/save', [OrderController::class, 'save'])->name('draft.save');
Route::delete('/drafts/{draft}', [OrderController::class, 'cancel'])->name('draft.cancel');
Route::post('/drafts/{draft}/assign-rider', [OrderController::class, 'assignRider'])->name('draft.assignRider');
Route::post('/drafts/{draft}/set-delivery-fee', [OrderController::class, 'setDeliveryFee'])->name('draft.setDeliveryFee');
Route::get('/drafts/{draft}/edit', [OrderController::class, 'edit'])
    ->name('drafts.edit');
Route::put('/orders/{order}/confirm', [OrderController::class, 'confirmOrder'])->name('orders.confirm');
Route::get('operator/draft', [OrderController::class, 'draft'])->name('operator.draft');
Route::get('operator/order', [OrderController::class, 'order'])->name('operator.order');
Route::get('/operator/dashboard', [OrderController::class, 'index'])->name('operator.dashboard');
Route::get('operator/dispatch', [OrderController::class, 'dispatch'])->name('operator.dispatch');
Route::get('operator/Riders', [OrderController::class, 'OperatorRiders'])->name('operator.Riders');
Route::get('operator/Payments', [OrderController::class, 'OperatorPayments'])->name('operator.payments');


Route::get('vendor/dashboard', [VendorController::class,'Dashboard'])->name('vendor.dashboard');
//   Route::delete('vendor/product-images/{image}', [VendorController::class, 'deleteImage'])->name('vendor.product-images.destroy');
//   Route::post('products', [VendorController::class,'edit'])->names('vendor.products');
// Route::get('vendor/products/create', [VendorController::class, 'create'])
//         ->name('vendor.products.create');
    
//     // Store New Product
    Route::post('vendor/products', [VendorController::class, 'store'])
         ->name('vendor.products.store');
    
//     // Show Single Product
//     Route::get('vendor/products/{product}', [VendorController::class, 'show'])
//         ->name('vendor.products.show');
    
//     // Show Edit Product Form
//     Route::get('vendor/products/{product}/edit', [VendorController::class, 'edit'])
//         ->name('vendor.products.edit');
    
//     // Update Product
//     Route::put('vendor/products/{product}', [VendorController::class, 'update'])
//         ->name('vendor.products.update');
    
//     // Delete Product
//     Route::delete('vendor/products/{product}', [VendorController::class, 'destroy'])
//         ->name('vendor.products.destroy');
    
//     // Additional routes you might need:
    
//     // Product Image Upload
//     Route::post('vendor/products/{product}/images', [VendorController::class, 'uploadImage'])
//         ->name('vendor.products.images.store');
      Route::get('/inventory/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
    Route::put('/inventory/{inventory}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('/inventory/{inventory}', [InventoryController::class, 'destroy'])->name('inventory.destroy');  
    
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('vendor.orders.show');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('vendor.orders.update');
Route::get('vendor/orders', [VendorController::class, 'VendorOrder'])->name('vendor.orders');
Route::get('vendor/products', [VendorController::class, 'product'])->name('vendor.products');
Route::view('vendor/payments', 'vendors.payment')->name('vendor.payments');
Route::view('operator/dashboard', 'operator.dashboard')->name('operator.dashboard');

Route::view('auth/document', 'auth.document')->name('auth.document');



Route::post('/document', [RolesController::class, 'DocumentPage'])->name('documents.submit');

Route::post('/update-profile', [AuthController::class, 'UpdateProfile'])->name('update.profile');
Route::post('/update-avatar',[AuthController::class, 'ChangeAvatar'])->name('update.avatar');
Route::post('/update', [AuthController::class, 'PasswordUpdate'])->name('update');
Route::Post('login',[AuthController::class, 'login'])->name('login');
Route::Post('logout',[AuthController::class, 'logout'])->name('logout');
Route::view('profile', 'auth.profile')->name('profile');

Route::get('/documents/{document}', [RolesController::class, 'DocumentShow'])->name('admin.documents.show');


Route::get('admin/roles', [RolesController::class, 'RolePage'])->name('admin.roles.page');
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::view('admin/orders', 'admin.order')->name('admin.order');
        // Route::view('admin/roles', 'admin.role')->name('admin.role');
        Route::get('admin/inventory', [InventoryController::class, 'index'])->name('admin.inventory');
        Route::view('admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
       
        Route::get('admin/vendors', [VendorController::class,'index'])->name('admin.vendor');
        Route::prefix('admin/vendors')->group(function() {
            Route::post('/{id}/approve', [VendorController::class, 'approve'])->name('admin.vendors.approve');
            Route::post('/{id}/reject', [VendorController::class, 'reject'])->name('admin.vendors.reject');
            Route::post('/{id}/suspend', [VendorController::class, 'suspend'])->name('admin.vendors.suspend');
            Route::post('/{id}/reactivate', [VendorController::class, 'reactivate'])->name('admin.vendors.reactivate');
            Route::delete('/{id}', [VendorController::class, 'destroy'])->name('admin.vendors.destroy');
        });

        Route::view('admin/customers', 'admin.customer')->name('admin.customer');
        Route::get('/download/document/{filename}', [RolesController::class, 'downloadDocument'])->name('download.document');
        Route::get('/admin/users/{user}', [RolesController::class, 'show'])->name('admin.users.show');
    
        // For editing users
        Route::get('/admin/users/{user}/edit', [RolesController::class, 'edit'])
            ->name('admin.users.edit');
        Route::post('/admin/documents/{document}/approve', [RolesController::class, 'approveDocument'])->name('admin.documents.approve');
        Route::post('/admin/documents/{document}/reject', [RolesController::class, 'rejectDocument'])->name('admin.documents.reject');
        Route::put('/admin/users/{user}', [RolesController::class, 'update'])
            ->name('admin.users.update');
        Route::post('/add-user', [AuthController::class, 'AddUser'])->name('user.add');

        // For deleting users
        Route::delete('/admin/users/{user}', [RolesController::class, 'destroy'])
            ->name('admin.users.destroy');
});