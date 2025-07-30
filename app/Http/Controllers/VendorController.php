<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    //admin vendors page is the index
    public function index(Request $request){
       
        $vendors = User::where('role', 'vendor')->orderBy('created_at', 'desc')
                    ->paginate(10); 
       
        $TotalVendors=User::where('role','vendor')->get();
        $TotalPendingApproval=User::where('role','vendor')->where('is_active','pending')->get()->count();
        $TotalActiveVendors=User::where('role','vendor')->where('is_active','active')->get()->count();
        $TotalSuspended=User::where('role','vendor')->where('is_active','inactive')->get()->count();
    
    return view('admin.vendor', compact('vendors','TotalActiveVendors', 'TotalPendingApproval', 'TotalSuspended', 'TotalVendors'));
}

    public function approve($id)
    {
        $vendor = User::findOrFail($id);
        $vendor->is_active = 'active';
        $vendor->save();

        return redirect()->route('admin.vendor')->with('success', 'Vendor approved successfully.');
    }

    public function reject($id)
    {
        $vendor = User::findOrFail($id);
        $vendor->is_active = 'rejected';
        $vendor->save();

        return redirect()->route('admin.vendor')->with('success', 'Vendor rejected successfully.');
    }

    public function suspend($id)
    {
        $vendor = User::findOrFail($id);
        $vendor->is_active = 'inactive';
        $vendor->save();

        return redirect()->route('admin.vendor')->with('success', 'Vendor suspended successfully.');
    }

    public function reactivate($id)
    {
        $vendor = User::findOrFail($id);
        $vendor->is_active = 'active';
        $vendor->save();

        return redirect()->route('admin.vendor')->with('success', 'Vendor reactivated successfully.');
    }

    public function destroy($id)
    {
        $vendor = User::findOrFail($id);
        $vendor->delete();

        return redirect()->route('admin.vendor')->with('success', 'Vendor deleted successfully.');
    }
    //vendor dashboard
    public function Dashboard(Request $request)
    {
    //    if (!$request->user() || 
    //     $request->user()->role !== 'admin' || 
    //     ($request->user()->role === 'vendor' && !$request->user()->documents()->exists())) {
        
    //     // If no user or not admin, or if vendor without documents
    //     return redirect()->route('LoginSignup')->with('error', 
    //         $request->user() && $request->user()->role === 'vendor' && !$request->user()->documents()->exists()
    //             ? 'Please submit your documents first'
    //             : 'You do not have permission to access this page.'
    //     );
    // }
       
       return view('vendors.dashboard');
        
    }


    public function product()
{
    $vendor = Vendor::where('vendor_id',auth()->id())  ;
    
    // Initialize empty paginator if no vendor exists
    // if (!$vendor) {
    //     $products = Product::whereNull('id')->paginate(10); // Empty paginated result
    //     return view('vendors.product', [
    //         'products' => $products,
    //         'TotalProducts' => 0,
    //         'TotalDraftProducts' => 0,
    //         'TotalAvailableProducts' => 0,
    //         'TotalOutStockProducts' => 0,
    //         'noVendor' => true
    //     ]);
    // }
    //dd($vendor);
    // Get paginated products (empty if none exist)
    $products =Product::where('vendor_id',auth()->id())->paginate(10);
    //dd($products);
    $TotalDraftProducts=Inventory::where('vendor_id',auth()->id())->where('status', 'draft')->count();
    $TotalAvailableProducts=Inventory::where('vendor_id',auth()->id())->where('status', 'in_stock')->count();
    $TotalOutStockProducts=Inventory::where('vendor_id',auth()->id())->where('status', 'out_of_stock')->count();
    //dd($products);
    // Get counts (will return 0 if no records exist)
    $TotalProducts = $products;
    $TotalDraftProducts = $TotalDraftProducts;
    $TotalAvailableProducts = $TotalAvailableProducts;
    $TotalOutStockProducts = $TotalOutStockProducts;

    return view('vendors.product', compact(
        'products',
        'TotalProducts',
        'TotalDraftProducts',
        'TotalAvailableProducts',
        'TotalOutStockProducts'
    ));
}

     public function edit(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }
        
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'compare_price' => $product->compare_price,
            'cost' => $product->cost,
            'sku' => $product->sku,
            'category_id' => $product->category_id,
            'status' => $product->status,
            'stock' => $product->stock,
            'weight' => $product->weight,
            'images' => $product->images->map(function($image) {
                return [
                    'id' => $image->id,
                    'url' => $image->url
                ];
            })
        ]);
    }
    
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'compare_price' => 'nullable|numeric|min:0',
        'cost' => 'nullable|numeric|min:0',
        'sku' => 'required|string|unique:products,sku',
        'category_id' => 'required',
        'stock' => 'required|integer|min:0',
        'weight' => 'nullable|numeric|min:0',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    ]);

    // Create product first
    $product = Product::create([
        'vendor_id' => auth()->id(),
        'name' => $validated['name'],
        'description' => $validated['description'] ?? null,
        'price' => $validated['price'],
        'compare_price' => $validated['compare_price'] ?? null,
        'cost' => $validated['cost'] ?? null,
        'sku' => $validated['sku'],
        'category_id' => $validated['category_id'],
        'stock' => $validated['stock'],
        'weight' => $validated['weight'] ?? null,
    ]);

    // Handle multiple image uploads
    if ($request->hasFile('images')) {
        $imagePaths = [];
        
        foreach ($request->file('images') as $image) {
            $path = $image->store('products', 'public');
            $imagePaths[] = $path;
            
            // Save each image to product_images table if you have that relationship
            // ProductImage::create([
            //     'product_id' => $product->id,
            //     'image_path' => $path,
            // ]);
        }

        // If you want to store all paths in the product's images field as JSON
        $product->update(['images' => json_encode($imagePaths)]);
    }

    // Inventory logic
    $inventory = Inventory::updateOrCreate(
        ['product_id' => $product->id],
        [
            'vendor_id' => auth()->id(),
            'quantity_received' => $product->stock,
            'quantity_available' => $product->stock,
            'status' => 'in_stock',
        ]
    );

    return redirect()->route('vendor.products')->with('success', 'Product created successfully!');
}



    public function deleteImage(ProductImage $image)
    {
        if ($image->product->user_id !== auth()->id()) {
            abort(403);
        }
        
        Storage::delete($image->path);
        $image->delete();
        
        return response()->json(['success' => true]);
    }


    
    
}