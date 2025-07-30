<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    //
    protected $fillable = [
        'product_id',
        'vendor_id',
        'quantity_received',
        'quantity_available',
        'status',
    ];

    public function index(Request $request)
{
    // Get summary statistics
    $TotalItems = Inventory::count();
    $LowStock = Inventory::where('quantity_available', '<', 3)->count();
    $BelowThreshold = Inventory::where('quantity_available', '<=', 0)->count();
    $Categories = Product::distinct()->pluck('category_id')->count();

    // Get paginated inventory items with related product data
    $inventoryItems = Inventory::with('product')->with('vendor')
        ->orderBy('quantity_available', 'asc')
        ->paginate(10);
    $products = Product::all();
    //dd($inventoryItems);
    return view('admin.inventory', compact(
        'TotalItems',
        'LowStock',
        'BelowThreshold',
        'Categories',
        'inventoryItems',
        'products'
    ));
}
}
