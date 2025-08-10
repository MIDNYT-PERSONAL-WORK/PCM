<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\OrderItems;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class VendorController extends Controller
{

public function analysic()
{
    $TotalProduct = Product::where('vendor_id', auth()->user()->id)->count();
    
    // Top selling product (all time)
    $TopSellingProduct = OrderItems::where('vendor_id', auth()->user()->id)
        ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('product_id')
        ->orderBy('total_quantity', 'desc')
        ->first();

    // Weekly top selling products
    $topSellingProducts = OrderItems::where('vendor_id', auth()->user()->id)
        ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->select('product_id', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(order_items.price * quantity) as revenue'))
        ->groupBy('product_id')
        ->orderBy('total_sold', 'desc')
        ->get();

    // Prepare chart data
    $monthlySales = OrderItems::where('vendor_id', auth()->user()->id)
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(order_items.price * quantity) as revenue'),
            DB::raw('SUM(quantity) as total_sold')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $weeklySales = OrderItems::where('vendor_id', auth()->user()->id)
        ->select(
            DB::raw('WEEK(created_at, 1) as week'),
            DB::raw('SUM(order_items.price * quantity) as revenue')
        )
        ->whereBetween('created_at', [now()->subWeeks(4), now()])
        ->groupBy('week')
        ->orderBy('week')
        ->get();

    // Modified category sales query to work with enum field and fix ambiguous column
    $categorySales = OrderItems::where('order_items.vendor_id', auth()->user()->id)
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->select(
            'products.category_id as category',
            DB::raw('SUM(order_items.price * quantity) as revenue')
        )
        ->whereBetween('order_items.created_at', [now()->startOfMonth(), now()->endOfMonth()])
        ->groupBy('products.category_id')
        ->get();

    $rankedProducts = $topSellingProducts->map(function ($product, $index) {
        $productDetails = Product::find($product->product_id);
        return [
            'rank' => $index + 1,
            'product_name' => $productDetails->name,
            'product_image' => $productDetails->images,
            'sku' => $productDetails->sku,
            'category' => $productDetails->category_id ?? 'N/A',
            'total_sold' => $product->total_sold,
            'revenue' => $product->revenue,
        ];
    });

    if ($TopSellingProduct) {
        $ProductName = Product::find($TopSellingProduct->product_id)->name;
        $ProductQuantity = $TopSellingProduct->total_quantity;
    }
$lowStockItems = Product::where('vendor_id', auth()->user()->id)
        ->where('stock', '<', 10) // Threshold for low stock
        ->orderBy('stock')
        ->get();

    $inventoryStatus = Product::where('vendor_id', auth()->user()->id)
        ->select(
            'id',
            'name',
            'sku',
            'images',
            'stock',
            'category_id as category'
        )
        ->get()
        ->map(function ($product) {
            // Calculate status based on stock level
            $status = 'Healthy';
            $statusClass = 'bg-green-100 text-green-800';
            
            if ($product->stock < 5) {
                $status = 'Critical';
                $statusClass = 'bg-red-100 text-red-800';
            } elseif ($product->stock < 10) {
                $status = 'Low';
                $statusClass = 'bg-yellow-100 text-yellow-800';
            }
            
            return [
                'id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'image' => $product->images ? json_decode($product->images)[0] : null,
                'category' => $product->category,
                'stock' => $product->stock,
                'status' => $status,
                'status_class' => $statusClass
            ];
        });

    return view('vendors.analysic', compact(
        'TotalProduct',
        'ProductName',
        'ProductQuantity',
        'rankedProducts',
        'monthlySales',
        'weeklySales',
        'categorySales',
        'lowStockItems',
        'inventoryStatus'
    ));
} 
    public function VendorOrder()
{
   // dd(Order::with('orderItems.product')->get());

    $vendorId = auth()->id();
    
    $query = Order::whereHas('orderItems', function($query) use ($vendorId) {
        $query->where('vendor_id', $vendorId);
    })
    ->with(['orderItems' => function($query) use ($vendorId) {
        $query->where('vendor_id', $vendorId)->with('product');
    }])
    ->orderBy('created_at', 'desc');

    // Apply status filter
    if (request()->has('status')) {
        $query->where('status', request('status'));
    }

    // Apply search filter
    if (request()->has('search')) {
        $search = request('search');
        $query->where(function($q) use ($search) {
            $q->where('order_number', 'like', "%{$search}%")
              ->orWhere('customer_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    // Apply date range filter
    if (request()->has('start_date') && request()->has('end_date')) {
        $query->whereBetween('created_at', [
            request('start_date') . ' 00:00:00',
            request('end_date') . ' 23:59:59'
        ]);
    }

    // Apply order total range filter
    if (request()->has('min_total')) {
        $query->where('grand_total', '>=', request('min_total'));
    }
    if (request()->has('max_total')) {
        $query->where('grand_total', '<=', request('max_total'));
    }

    $orders = $query->paginate(10);

    // Rest of your counts should also respect the filters
    $TotalOrder = (clone $query)->count();
    $PendingOrder = (clone $query)->where('status', 'pending')->count();
    $DeliveredOrder = (clone $query)->where('status', 'delivered')->count();
    $ProcessingOrder = (clone $query)->where('status', 'processing')->count();

    // Last week counts (these shouldn't be filtered)
    $lastWeek = now()->subWeek();
    $TotalOrderLastWeek = Order::whereHas('orderItems', function($query) use ($vendorId) {
        $query->where('vendor_id', $vendorId);
    })->where('created_at', '>=', $lastWeek)->count();

    $DeliveredOrderLastWeek = Order::whereHas('orderItems', function($query) use ($vendorId) {
        $query->where('vendor_id', $vendorId);
    })->where('status', 'delivered')
      ->where('created_at', '>=', $lastWeek)->count();

    return view('vendors.order', compact(
        'TotalOrder', 
        'PendingOrder', 
        'DeliveredOrder', 
        'ProcessingOrder',
        'TotalOrderLastWeek',
        'DeliveredOrderLastWeek',
        'orders'
    ));
}
    public function show($id)
{
    // Fetch the order with related order items and products, ensuring the vendor owns the products
    $order = Order::with(['orderItems.product' => function ($query) {
        $query->where('vendor_id', auth()->id())
              ->select('id', 'name', 'sku'); // Select only necessary fields
    }])->findOrFail($id);

    // Verify vendor owns items in this order
    if ($order->orderItems->isEmpty()) {
        return response()->json(['error' => 'Unauthorized access to order'], 403);
    }

    // Transform order items to include product name and SKU
    $orderItems = $order->orderItems->map(function ($item) {
        return [
            'id' => $item->id,
            'order_id' => $item->order_id,
            'product_id' => $item->product_id,
            'product_name' => $item->product ? $item->product->name : 'N/A',
            'sku' => $item->product ? $item->product->sku : 'N/A',
            'price' => $item->price,
            'quantity' => $item->quantity,
            'amount' => $item->amount,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });

    return response()->json([
        'order' => $order,
        'order_items' => $orderItems,
        'success' => true
    ]);
}
    
    
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
    $vendorId = auth()->id();
    // Get orders that have items belonging to this vendor
    $orders = Order::whereHas('OrderItems', function($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })
        ->with(['OrderItems' => function($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        }])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // Calculate statistics
    $TotalOrder = $orders->count();
    $TotalRevenue = $orders->sum('amount'); // Assuming 'amount' is the total order amount
    $AVgOrder = $TotalOrder > 0 ? $TotalRevenue / $TotalOrder : 0;
    $PendingOrder = $orders->where('status', 'pending')->count();
    //dd($TotalOrder, $TotalRevenue, $AVgOrder, $PendingOrder);
        // Weekly orders data
    $weeklyOrders = $this->getWeeklyOrdersData($vendorId);
    $revenueData = $this->getInitialRevenueData($vendorId);
    //dd($TotalOrder, $TotalRevenue, $AVgOrder, $PendingOrder);
       return view('vendors.dashboard', compact('TotalOrder', 'TotalRevenue', 'AVgOrder', 'PendingOrder', 'orders', 'weeklyOrders', 'revenueData'));
        
    }

    // Add these to your existing VendorController

    public function getRevenueData(Request $request)
    {
        $vendorId = auth()->id();
        $period = $request->input('period', 'last_7_days');
        
        switch ($period) {
            case 'last_30_days':
                return $this->getLast30DaysRevenue($vendorId);
            case 'this_year':
                return $this->getYearlyRevenue($vendorId);
            case 'last_7_days':
            default:
                return $this->getLast7DaysRevenue($vendorId);
        }
    }

    private function getLast7DaysRevenue($vendorId)
    {
        $dates = collect();
        $data = collect();
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates->push($date->format('D'));
            
            $total = Order::whereHas('orderItems', function($query) use ($vendorId) {
                    $query->where('vendor_id', $vendorId);
                })
                ->whereDate('created_at', $date->format('Y-m-d'))
                ->sum('amount');
                
            $data->push($total);
        }
        
        return response()->json([
            'labels' => $dates,
            'data' => $data
        ]);
    }

    private function getLast30DaysRevenue($vendorId)
    {
        $dates = collect();
        $data = collect();
        
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates->push($date->format('M d'));
            
            $total = Order::whereHas('orderItems', function($query) use ($vendorId) {
                    $query->where('vendor_id', $vendorId);
                })
                ->whereDate('created_at', $date->format('Y-m-d'))
                ->sum('amount');
                
            $data->push($total);
        }
        
        return response()->json([
            'labels' => $dates,
            'data' => $data
        ]);
    }

    private function getYearlyRevenue($vendorId)
    {
        $months = collect();
        $data = collect();
        
        for ($i = 1; $i <= 12; $i++) {
            $month = Carbon::create(null, $i, 1);
            $months->push($month->format('M'));
            
            $total = Order::whereHas('orderItems', function($query) use ($vendorId) {
                    $query->where('vendor_id', $vendorId);
                })
                ->whereMonth('created_at', $i)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('amount');
                
            $data->push($total);
        }
        
        return response()->json([
            'labels' => $months,
            'data' => $data
        ]);
    }

    private function getInitialRevenueData($vendorId)
    {
        $dates = collect();
        $data = collect();
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates->push($date->format('D'));
            
            $total = Order::whereHas('orderItems', function($query) use ($vendorId) {
                    $query->where('vendor_id', $vendorId);
                })
                ->whereDate('created_at', $date->format('Y-m-d'))
                ->sum('amount');
                
            $data->push($total);
        }
        
        return [
            'labels' => $dates,
            'data' => $data
        ];
    }

     public function getChartData(Request $request)
    {
        $vendorId = auth()->id();
        $period = $request->input('period', 'this_week');
        
        switch ($period) {
            case 'last_week':
                $start = Carbon::now()->subWeek()->startOfWeek();
                $end = Carbon::now()->subWeek()->endOfWeek();
                break;
            case 'this_month':
                return $this->getMonthlyOrdersData($vendorId);
            case 'this_week':
            default:
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
        }
        
        $ordersByDay = Order::whereHas('orderItems', function($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw('DAYNAME(created_at) as day, COUNT(*) as count')
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $weeklyData = array_fill_keys($daysOfWeek, 0);
        
        foreach ($ordersByDay as $day => $count) {
            $weeklyData[$day] = $count;
        }
        
        return response()->json([
            'labels' => array_map(function($day) { return substr($day, 0, 3); }, $daysOfWeek),
            'data' => array_values($weeklyData)
        ]);
    }

    private function getWeeklyOrdersData($vendorId)
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        $ordersByDay = Order::whereHas('orderItems', function($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw('DAYNAME(created_at) as day, COUNT(*) as count')
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $weeklyData = array_fill_keys($daysOfWeek, 0);
        
        foreach ($ordersByDay as $day => $count) {
            $weeklyData[$day] = $count;
        }
        
        return [
            'labels' => array_map(function($day) { return substr($day, 0, 3); }, $daysOfWeek),
            'data' => array_values($weeklyData)
        ];
    }

    private function getMonthlyOrdersData($vendorId)
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        $ordersByWeek = Order::whereHas('orderItems', function($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->selectRaw('WEEK(created_at, 1) - WEEK(DATE_SUB(created_at, INTERVAL DAYOFMONTH(created_at)-1 DAY), 1) + 1 as week, COUNT(*) as count')
            ->groupBy('week')
            ->pluck('count', 'week')
            ->toArray();

        $weeksInMonth = ceil(Carbon::now()->daysInMonth / 7);
        $monthlyData = array_fill(1, $weeksInMonth, 0);
        
        foreach ($ordersByWeek as $week => $count) {
            $monthlyData[$week] = $count;
        }
        
        return [
            'labels' => array_map(function($week) { return "Week $week"; }, array_keys($monthlyData)),
            'data' => array_values($monthlyData)
        ];
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