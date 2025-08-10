<x-vendor-nav>
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-pam-blue">Product Analytics</h2>
            <p class="text-pam-gray">Track your product performance and trends</p>
        </div>
        <div class="mt-4 md:mt-0">
            <div class="relative">
                <select class="appearance-none bg-white border border-pam-gray-light rounded-lg px-4 py-2 pr-8 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    <option>Last 30 Days</option>
                    <option>Last 90 Days</option>
                    <option>This Year</option>
                </select>
                <div class="absolute right-3 top-2.5 text-pam-gray">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Total Products</div>
            <div class="text-2xl font-bold text-pam-blue">{{$TotalProduct}}</div>
            <div class="text-xs text-pam-gray">+3 from last month</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Top Selling Product</div>
            <div class="text-2xl font-bold text-pam-blue">{{$ProductName}}</div>
            <div class="text-xs text-pam-gray">{{$ProductQuantity}} sold this week</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Revenue</div>
            <div class="text-2xl font-bold text-pam-blue">$8,742.50</div>
            <div class="text-xs text-pam-green flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                12% increase
            </div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Avg. Rating</div>
            <div class="text-2xl font-bold text-pam-blue">4.6</div>
            <div class="text-xs text-pam-gray">From 84 reviews</div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="border-b border-pam-gray-light mb-6">
        <nav class="-mb-px flex space-x-8">
            <button id="trendsTab" class="border-b-2 border-pam-blue text-pam-blue whitespace-nowrap py-4 px-1 font-medium text-sm">
                Sales Trends
            </button>
            <button id="rankingTab" class="border-b-2 border-transparent text-pam-gray hover:text-pam-blue hover:border-pam-gray-light whitespace-nowrap py-4 px-1 font-medium text-sm">
                Product Rankings
            </button>
            <button id="inventoryTab" class="border-b-2 border-transparent text-pam-gray hover:text-pam-blue hover:border-pam-gray-light whitespace-nowrap py-4 px-1 font-medium text-sm">
                Inventory Analysis
            </button>
        </nav>
    </div>

    <!-- Trends Tab Content -->
    <div id="trendsContent" class="tab-content">
        <!-- Monthly Sales Performance Chart -->
        <div class="bg-white p-4 rounded-lg border border-pam-gray-light mb-6">
            <h3 class="text-lg font-medium text-pam-blue mb-4">Monthly Sales Performance</h3>
            <div class="h-80">
                <canvas id="monthlySalesChart"></canvas>
            </div>
        </div>

        <!-- Weekly Sales Volume Chart -->
        <div class="bg-white p-4 rounded-lg border border-pam-gray-light">
            <h3 class="text-lg font-medium text-pam-blue mb-4">Weekly Sales Volume</h3>
            <div class="h-64">
                <canvas id="weeklySalesChart"></canvas>
            </div>
        </div>

        <!-- Product Category Breakdown Chart -->
        <div class="bg-white p-4 rounded-lg border border-pam-gray-light">
            <h3 class="text-lg font-medium text-pam-blue mb-4">Product Category Breakdown</h3>
            <div class="h-64">
                <canvas id="categorySalesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Ranking Tab Content -->
    <div id="rankingContent" class="tab-content hidden">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <div class="flex items-center space-x-2">
                <button class="px-3 py-1 bg-pam-blue text-white rounded-lg text-sm">All Products</button>
                {{-- <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Physical</button>
                <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Digital</button> --}}
            </div>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    <div class="absolute left-3 top-2.5 text-pam-gray">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-pam-gray-light">
        <thead class="bg-pam-gray-light">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Rank</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Product</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Category</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Units Sold</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Revenue</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Trend</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-pam-gray-light">
            @forelse($rankedProducts as $product)
            <tr class="hover:bg-pam-gray-light/50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="w-6 h-6 
                        @switch($product['rank'])
                            @case(1) bg-pam-blue @break
                            @case(2) bg-blue-400 @break
                            @case(3) bg-green-400 @break
                            @default bg-gray-400
                        @endswitch
                        text-white rounded-full flex items-center justify-center">
                        {{ $product['rank'] }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-pam-gray-light rounded-md overflow-hidden">
                            @if($product['product_image'] )
                                    @foreach(json_decode($product['product_image']) as $imagePath)
                                        <img src="{{ asset('storage/'.$imagePath) }}" alt="Product image" class="h-full w-full object-cover">
                                    @endforeach
                                @else
                                    <img src="https://via.placeholder.com/80" alt="Product image" class="h-full w-full object-cover">
                                @endif
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-pam-blue">{{ $product['product_name'] }}</div>
                            <div class="text-sm text-pam-gray">SKU: {{ $product['sku'] }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-pam-gray">{{ $product['category'] }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-pam-blue">{{ $product['total_sold'] }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-pam-green">${{ number_format($product['revenue'], 2) }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        {{-- @if($product['trend'] > 0)
                            <svg class="w-4 h-4 text-pam-green mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                            </svg>
                            <span class="text-xs text-pam-green">{{ $product['trend'] }}%</span>
                        @elseif($product['trend'] < 0)
                            <svg class="w-4 h-4 text-red-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                            <span class="text-xs text-red-500">{{ abs($product['trend']) }}%</span>
                        @else
                            <span class="text-xs text-gray-500">-</span>
                        @endif --}}
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-pam-gray">No products sold this week</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($rankedProducts->count() > 0)
<div class="flex items-center justify-between mt-6">
    <div class="text-sm text-pam-gray">
        Showing <span class="font-medium">1</span> to <span class="font-medium">{{ $rankedProducts->count() }}</span> of <span class="font-medium">{{ $rankedProducts->count() }}</span> products
    </div>
    <!-- Add pagination links if you implement pagination in the future -->
</div>
@endif
    </div>

    
    <!-- Inventory Tab Content -->
<div id="inventoryContent" class="tab-content hidden">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Low Stock Alert -->
        <div class="bg-white p-4 rounded-lg border border-pam-gray-light">
            <h3 class="text-lg font-medium text-pam-blue mb-4">Low Stock Alert</h3>
            <div class="space-y-4">
                @forelse($lowStockItems as $item)
                <div class="flex items-center justify-between p-3 {{ $item->stock < 5 ? 'bg-red-50' : 'bg-yellow-50' }} rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-pam-gray-light rounded-md overflow-hidden mr-3">
                            @if($item->images)
                                <img class="h-full w-full object-cover" 
                                     src="{{ asset('storage/'.json_decode($item->images)[0]) }}" 
                                     alt="{{ $item->name }}">
                            @else
                                <img class="h-full w-full object-cover" 
                                     src="https://via.placeholder.com/40" 
                                     alt="Product image">
                            @endif
                        </div>
                        <div>
                            <div class="text-sm font-medium text-pam-blue">{{ $item->name }}</div>
                            <div class="text-xs text-pam-gray">SKU: {{ $item->sku }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium {{ $item->stock < 5 ? 'text-red-500' : 'text-yellow-600' }}">
                            {{ $item->stock }} left
                        </div>
                        <div class="text-xs text-pam-gray">Reorder now</div>
                    </div>
                </div>
                @empty
                <div class="p-4 text-center text-pam-gray">
                    No low stock items
                </div>
                @endforelse
            </div>
        </div>
        
        <!-- Inventory Turnover Chart -->
        <div class="bg-white p-4 rounded-lg border border-pam-gray-light">
            <h3 class="text-lg font-medium text-pam-blue mb-4">Inventory Turnover</h3>
            <div class="h-64">
                <canvas id="inventoryTurnoverChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Full Inventory Status -->
    <div class="bg-white p-4 rounded-lg border border-pam-gray-light">
        <h3 class="text-lg font-medium text-pam-blue mb-4">Full Inventory Status</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-pam-gray-light">
                <thead class="bg-pam-gray-light">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Product</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Current Stock</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-pam-gray-light">
                    @foreach($inventoryStatus as $item)
                    <tr class="hover:bg-pam-gray-light/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-pam-gray-light rounded-md overflow-hidden mr-3">
                                    @if($item['image'])
                                        <img class="h-full w-full object-cover" 
                                             src="{{ asset('storage/'.$item['image']) }}" 
                                             alt="{{ $item['name'] }}">
                                    @else
                                        <img class="h-full w-full object-cover" 
                                             src="https://via.placeholder.com/40" 
                                             alt="Product image">
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-pam-blue">{{ $item['name'] }}</div>
                                    <div class="text-xs text-pam-gray">SKU: {{ $item['sku'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">{{ $item['category'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-pam-blue">{{ $item['stock'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item['status_class'] }}">
                                {{ $item['status'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
    // Tab switching functionality
    document.getElementById('trendsTab').addEventListener('click', function() {
        switchTab('trends');
    });
    
    document.getElementById('rankingTab').addEventListener('click', function() {
        switchTab('ranking');
    });
    
    document.getElementById('inventoryTab').addEventListener('click', function() {
        switchTab('inventory');
    });
    
    function switchTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Remove active class from all tabs
        document.querySelectorAll('[id$="Tab"]').forEach(tab => {
            tab.classList.remove('border-pam-blue', 'text-pam-blue');
            tab.classList.add('border-transparent', 'text-pam-gray');
        });
        
        // Show selected tab content and mark tab as active
        document.getElementById(`${tabName}Content`).classList.remove('hidden');
        document.getElementById(`${tabName}Tab`).classList.add('border-pam-blue', 'text-pam-blue');
        document.getElementById(`${tabName}Tab`).classList.remove('border-transparent', 'text-pam-gray');
    }

    // Inventory Turnover Chart
const inventoryCtx = document.getElementById('inventoryTurnoverChart').getContext('2d');
const inventoryChart = new Chart(inventoryCtx, {
    type: 'bar',
    data: {
        labels: ['Electronics', 'Accessories', 'Clothing', 'Home & Garden', 'Books', 'Sports', 'Beauty'],
        datasets: [{
            label: 'Turnover Rate',
            data: [3.2, 2.8, 4.1, 2.5, 1.9, 3.5, 3.8], // Example data - replace with real calculations
            backgroundColor: 'rgba(59, 130, 246, 0.7)',
            borderColor: 'rgba(59, 130, 246, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Turnover Rate'
                }
            }
        }
    }
});
    
    // Monthly Sales Chart (Line)
    const monthlyCtx = document.getElementById('monthlySalesChart').getContext('2d');
    const monthlyChart = new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Monthly Revenue ($)',
                data: @json(array_fill(0, 12, 0)), // Initialize with zeros
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Populate monthly data from backend
    @foreach($monthlySales as $sale)
        monthlyChart.data.datasets[0].data[{{ $sale->month - 1 }}] = {{ $sale->revenue }};
    @endforeach
    monthlyChart.update();

    // Weekly Sales Chart (Bar)
    const weeklyCtx = document.getElementById('weeklySalesChart').getContext('2d');
    const weeklyChart = new Chart(weeklyCtx, {
        type: 'bar',
        data: {
            labels: @json(array_map(function($week) { 
                return 'Week ' . $week; 
            }, range(1, 5))),
            datasets: [{
                label: 'Weekly Revenue ($)',
                data: @json(array_fill(0, 4, 0)), // Initialize with zeros
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Populate weekly data from backend
    @foreach($weeklySales as $sale)
        weeklyChart.data.datasets[0].data[{{ $sale->week - date('W') + 4 }}] = {{ $sale->revenue }};
    @endforeach
    weeklyChart.update();

    // Category Sales Chart (Doughnut)
    const categoryCtx = document.getElementById('categorySalesChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: @json($categorySales->pluck('category')),
        datasets: [{
            data: @json($categorySales->pluck('revenue')),
            backgroundColor: [
                'rgba(59, 130, 246, 0.7)',
                'rgba(16, 185, 129, 0.7)',
                'rgba(245, 158, 11, 0.7)',
                'rgba(239, 68, 68, 0.7)',
                'rgba(139, 92, 246, 0.7)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right',
            }
        }
    }
});
</script>

</x-vendor-nav>