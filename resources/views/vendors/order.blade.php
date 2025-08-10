<x-vendor-nav>
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-pam-blue">Order Management</h2>
            <p class="text-pam-gray">Track and manage all customer orders</p>
        </div>
    </div>

    <!-- Order Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Total Orders</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $TotalOrder }}</div>
            <div class="text-xs text-pam-green flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                8% from last week
            </div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Pending</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $PendingOrder }}</div>
            <div class="text-xs text-pam-gray">Requires action</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">In Transit</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $ProcessingOrder }}</div>
            <div class="text-xs text-pam-gray">Active shipments</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Delivered</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $DeliveredOrder }}</div>
            <div class="text-xs text-pam-green flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                12% from last week
            </div>
        </div>
    </div>

    <!-- Filter and Search Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
        <!-- Status Filter Buttons -->
        <div class="flex items-center overflow-x-auto space-x-2">
            <a href="{{ route('vendor.orders') }}" 
               class="px-3 py-1 rounded-lg text-sm {{ !request('status') ? 'bg-pam-blue text-white' : 'border border-pam-gray-light text-pam-gray hover:bg-pam-gray-light/50' }}"
               aria-label="Filter by All Orders">
                All
            </a>
            <a href="{{ route('vendor.orders', ['status' => 'pending']) }}" 
               class="px-3 py-1 rounded-lg text-sm {{ request('status') == 'pending' ? 'bg-pam-blue text-white' : 'border border-pam-gray-light text-pam-gray hover:bg-pam-gray-light/50' }}"
               aria-label="Filter by Pending Orders">
                Pending
            </a>
            <a href="{{ route('vendor.orders', ['status' => 'processing']) }}" 
               class="px-3 py-1 rounded-lg text-sm {{ request('status') == 'processing' ? 'bg-pam-blue text-white' : 'border border-pam-gray-light text-pam-gray hover:bg-pam-gray-light/50' }}"
               aria-label="Filter by Processing Orders">
                Processing
            </a>
            <a href="{{ route('vendor.orders', ['status' => 'shipped']) }}" 
               class="px-3 py-1 rounded-lg text-sm {{ request('status') == 'shipped' ? 'bg-pam-blue text-white' : 'border border-pam-gray-light text-pam-gray hover:bg-pam-gray-light/50' }}"
               aria-label="Filter by Shipped Orders">
                Shipped
            </a>
            <a href="{{ route('vendor.orders', ['status' => 'delivered']) }}" 
               class="px-3 py-1 rounded-lg text-sm {{ request('status') == 'delivered' ? 'bg-pam-blue text-white' : 'border border-pam-gray-light text-pam-gray hover:bg-pam-gray-light/50' }}"
               aria-label="Filter by Delivered Orders">
                Delivered
            </a>
            <a href="{{ route('vendor.orders', ['status' => 'cancelled']) }}" 
               class="px-3 py-1 rounded-lg text-sm {{ request('status') == 'cancelled' ? 'bg-pam-blue text-white' : 'border border-pam-gray-light text-pam-gray hover:bg-pam-gray-light/50' }}"
               aria-label="Filter by Cancelled Orders">
                Cancelled
            </a>
        </div>

        <!-- Search Box -->
        <div class="flex items-center gap-2">
            <form method="GET" action="{{ route('vendor.orders') }}" class="relative">
                <label for="search" class="sr-only">Search orders</label>
                <input type="text" 
                       id="search"
                       name="search" 
                       placeholder="Search orders..." 
                       value="{{ request('search') }}"
                       class="w-full pl-10 pr-4 py-2 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition"
                       aria-label="Search orders by ID, customer, or other details">
                <div class="absolute left-3 top-2.5 text-pam-gray">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
            </form>
            
            <!-- Advanced Filters Button -->
            <button class="p-2 border border-pam-gray-light rounded-lg hover:bg-pam-gray-light/50"
                    onclick="toggleAdvancedFilters()"
                    aria-label="Toggle advanced filters"
                    aria-controls="advancedFilters"
                    aria-expanded="false">
                <svg class="w-5 h-5 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Advanced Filters Panel -->
    <div id="advancedFilters" class="hidden mb-6 p-4 bg-pam-gray-light rounded-lg">
        <form method="GET" action="{{ route('vendor.orders') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Date Range -->
            <div>
                <label class="block text-sm font-medium text-pam-gray mb-1">Date Range</label>
                <div class="flex space-x-2">
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="border border-pam-gray-light rounded-lg px-3 py-2 w-full" aria-label="Start date">
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="border border-pam-gray-light rounded-lg px-3 py-2 w-full" aria-label="End date">
                </div>
            </div>
            
            <!-- Order Total Range -->
            <div>
                <label class="block text-sm font-medium text-pam-gray mb-1">Order Total</label>
                <div class="flex space-x-2">
                    <input type="number" name="min_total" placeholder="Min" value="{{ request('min_total') }}" class="border border-pam-gray-light rounded-lg px-3 py-2 w-full" aria-label="Minimum order total">
                    <input type="number" name="max_total" placeholder="Max" value="{{ request('max_total') }}" class="border border-pam-gray-light rounded-lg px-3 py-2 w-full" aria-label="Maximum order total">
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex items-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-pam-blue text-white rounded-lg hover:bg-pam-blue-light transition" aria-label="Apply filters">
                    Apply Filters
                </button>
                <a href="{{ route('vendor.orders') }}" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition" aria-label="Reset filters">
                    Reset
                </a>
            </div>
            
            <!-- Hidden fields to preserve other filters -->
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
        </form>
    </div>

    <!-- Orders Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-pam-gray-light">
            <thead class="bg-pam-gray-light">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Order ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Customer</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Items</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Total</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-pam-gray uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pam-gray-light">
                @foreach($orders as $order)
                <tr class="hover:bg-pam-gray-light/50 cursor-pointer" onclick="openOrderModal('{{ $order->id }}')" role="button" aria-label="View order details for order {{ $order->order_number }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-pam-blue">#{{ $order->order_number }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">{{ $order->customer_name }}</div>
                        <div class="text-xs text-pam-gray">{{ $order->phone }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">{{ $order->orderItems->count() }} items</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'processing' => 'bg-blue-100 text-blue-800',
                                'shipped' => 'bg-purple-100 text-purple-800',
                                'delivered' => 'bg-green-100 text-green-800',
                                'cancelled' => 'bg-red-100 text-red-800'
                            ];
                            $statusClass = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}"
                              aria-label="Order status: {{ ucfirst($order->status) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-pam-blue">GHC{{ $order->amount }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">{{ $order->created_at->format('d M Y, h:i A') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" onclick="event.stopPropagation()">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3" 
                                onclick="openOrderModal('{{ $order->id }}')"
                                aria-label="View details for order {{ $order->order_number }}">View</button>
                        @if($order->status == 'pending')
                            <button class="text-pam-green hover:text-green-700" 
                                    onclick="processOrderAction('{{ $order->id }}', 'processing')"
                                    aria-label="Process order {{ $order->order_number }}">Process</button>
                        @elseif($order->status == 'processing')
                            <button class="text-pam-green hover:text-green-700" 
                                    onclick="processOrderAction('{{ $order->id }}', 'shipped')"
                                    aria-label="Mark order {{ $order->order_number }} as shipped">Ship</button>
                        @elseif($order->status == 'shipped')
                            <button class="text-pam-green hover:text-green-700" 
                                    onclick="showTrackingInput('{{ $order->id }}')"
                                    aria-label="Track order {{ $order->order_number }}">Track</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-pam-gray">
            Showing <span class="font-medium">{{ $orders->firstItem() }}</span> to <span class="font-medium">{{ $orders->lastItem() }}</span> of <span class="font-medium">{{ $orders->total() }}</span> orders
        </div>
        <div class="flex space-x-2">
            @if($orders->onFirstPage())
                <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50 disabled:opacity-50" disabled aria-label="Previous page (disabled)">
                    Previous
                </button>
            @else
                <a href="{{ $orders->previousPageUrl() }}" class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50" aria-label="Previous page">
                    Previous
                </a>
            @endif

            @foreach(range(1, $orders->lastPage()) as $page)
                @if($page == $orders->currentPage())
                    <span class="px-3 py-1 border border-pam-blue-light bg-pam-blue-light text-white rounded-lg" aria-current="page">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $orders->url($page) }}" class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50" aria-label="Page {{ $page }}">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            @if($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50" aria-label="Next page">
                    Next
                </a>
            @else
                <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50 disabled:opacity-50" disabled aria-label="Next page (disabled)">
                    Next
                </button>
            @endif
        </div>
    </div>
</div>

<!-- Order Detail Modal -->
<div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" role="dialog" aria-labelledby="modalOrderId" aria-modal="true">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-bold text-pam-blue">Order #<span id="modalOrderId"></span></h3>
                    <p class="text-sm text-pam-gray" id="modalOrderDate"></p>
                </div>
                <div class="flex items-center space-x-2">
                    <span id="modalOrderStatus" class="px-2 py-1 rounded-full text-xs font-medium"></span>
                    <button onclick="closeOrderModal()" class="text-pam-gray hover:text-pam-blue" aria-label="Close order details modal">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Customer Info -->
                <div class="bg-pam-gray-light rounded-lg p-4">
                    <h4 class="font-medium text-pam-blue mb-2">Customer Information</h4>
                    <div class="flex items-center mb-2">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light flex items-center justify-center">
                            <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-pam-gray" id="modalCustomerName"></p>
                            <p class="text-xs text-pam-gray" id="modalCustomerEmail"></p>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-pam-gray-light/50">
                        <h4 class="font-medium text-pam-blue mb-2">Shipping Address</h4>
                        <p class="text-sm text-pam-gray" id="modalShippingAddress"></p>
                        <div class="mt-2 flex items-center text-sm text-pam-blue-light">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span id="modalCustomerPhone"></span>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="bg-pam-gray-light rounded-lg p-4">
                    <h4 class="font-medium text-pam-blue mb-2">Order Summary</h4>
                    <div class="flex justify-between text-sm text-pam-gray mb-1">
                        <span>Subtotal</span>
                        <span id="modalSubtotal"></span>
                    </div>
                    <div class="flex justify-between text-sm text-pam-gray mb-1">
                        <span>Shipping</span>
                        <span id="modalShipping"></span>
                    </div>
                    <div class="flex justify-between text-sm text-pam-gray mb-1">
                        <span>Tax</span>
                        <span id="modalTax"></span>
                    </div>
                    <div class="flex justify-between text-sm text-pam-gray mb-1">
                        <span>Discount</span>
                        <span id="modalDiscount"></span>
                    </div>
                    <div class="mt-3 pt-3 border-t border-pam-gray-light/50 flex justify-between font-medium text-pam-blue">
                        <span>Total</span>
                        <span id="modalTotal"></span>
                    </div>
                    <div class="mt-3 pt-3 border-t border-pam-gray-light/50">
                        <h4 class="font-medium text-pam-blue mb-2">Payment Method</h4>
                        <p class="text-sm text-pam-gray" id="modalPaymentMethod"></p>
                        <p class="text-sm text-pam-gray" id="modalPaymentStatus"></p>
                    </div>
                </div>
                
                <!-- Shipping & Rider Info -->
                <div class="bg-pam-gray-light rounded-lg p-4">
                    <h4 class="font-medium text-pam-blue mb-2">Shipping Information</h4>
                    <p class="text-sm text-pam-gray" id="modalShippingMethod"></p>
                    <p class="text-sm text-pam-gray" id="modalDeliveryEstimate"></p>
                    
                    <div class="mt-3 pt-3 border-t border-pam-gray-light/50">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-medium text-pam-blue">Assigned Rider</h4>
                            {{-- <button onclick="openRiderAssignmentModal()" class="text-xs text-pam-blue-light hover:text-pam-blue" aria-label="Change assigned rider">Change</button> --}}
                        </div>
                        <div id="riderInfo" class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light flex items-center justify-center">
                                <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-pam-gray" id="modalRiderName">Unassigned</p>
                                <p class="text-xs text-pam-gray" id="modalRiderStatus">Click to assign a rider</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3 pt-3 border-t border-pam-gray-light/50">
                        <h4 class="font-medium text-pam-blue mb-2">Tracking</h4>
                        <p class="text-sm text-pam-gray" id="modalTrackingStatus"></p>
                        <div id="trackingInput" class="mt-2 hidden">
                            <div class="flex">
                                <input type="text" id="trackingNumberInput" placeholder="Enter tracking number" class="flex-1 border border-pam-gray-light rounded-l-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition" aria-label="Enter tracking number">
                                <button class="bg-pam-blue-light text-white px-3 py-2 rounded-r-lg hover:bg-pam-blue transition" onclick="saveTrackingNumber()" aria-label="Save tracking number">Save</button>
                            </div>
                        </div>
                        {{-- <button id="addTrackingBtn" class="mt-2 text-sm text-pam-blue-light hover:text-pam-blue" onclick="showTrackingInput()" aria-label="Add tracking number">Add Tracking Number</button> --}}
                    </div>
                </div>
            </div>
            
            <!-- Order Items -->
            <div class="mb-6">
                <h4 class="font-medium text-pam-blue mb-3">Order Items</h4>
                <div class="border border-pam-gray-light rounded-lg overflow-hidden overflow-x-auto">
                    <table class="min-w-full divide-y divide-pam-gray-light">
                        <thead class="bg-pam-gray-light">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Product</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">SKU</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Qty</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-pam-gray uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-pam-gray-light " id="orderItemsList"></tbody>
                    </table>
                </div>
            </div>
            
            <!-- Order Actions -->
            <div class="flex justify-between items-center pt-4 border-t border-pam-gray-light">
                <div>
                    <button class="text-sm text-pam-gray hover:text-pam-blue flex items-center" onclick="printInvoice()" aria-label="Print invoice">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Print Invoice
                    </button>
                </div>
                <div class="flex space-x-3">
                    <button onclick="closeOrderModal()" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition" aria-label="Close modal">Close</button>
                    {{-- <button id="orderActionBtn" class="px-4 py-2 bg-pam-green text-white rounded-lg hover:bg-green-600 transition hidden" onclick="processOrderAction()" aria-label="Process order">Process Order</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rider Assignment Modal -->
{{-- <div id="riderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" role="dialog" aria-labelledby="riderModalTitle" aria-modal="true">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-pam-blue" id="riderModalTitle">Assign Rider</h3>
                <button onclick="closeRiderAssignmentModal()" class="text-pam-gray hover:text-pam-blue" aria-label="Close rider assignment modal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-pam-gray mb-2">Available Riders</label>
                <div class="space-y-2 max-h-60 overflow-y-auto" id="riderList"></div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button onclick="closeRiderAssignmentModal()" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition" aria-label="Cancel rider assignment">Cancel</button>
                <button onclick="unassignRider()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition" aria-label="Unassign rider">Unassign</button>
            </div>
        </div>
    </div>
</div> --}}

<script>
    // Status badge classes mapping
    const statusClasses = {
        'pending': 'bg-yellow-100 text-yellow-800',
        'confirmed': 'bg-blue-100 text-blue-800',
        'processing': 'bg-purple-100 text-purple-800',
        'shipped': 'bg-green-100 text-green-800',
        'delivered': 'bg-green-100 text-green-800',
        'cancelled': 'bg-red-100 text-red-800'
    };

    // Current order being viewed
    let currentOrder = null;

    // Get CSRF token safely
    const getCsrfToken = () => document.querySelector('meta[name="csrf-token"]')?.content || '';

    // Toggle advanced filters panel
    function toggleAdvancedFilters() {
        const filtersPanel = document.getElementById('advancedFilters');
        const button = document.querySelector('[aria-controls="advancedFilters"]');
        const isHidden = filtersPanel.classList.toggle('hidden');
        button.setAttribute('aria-expanded', !isHidden);
    }

    // Close order modal
    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
        currentOrder = null;
    }

    // Close rider assignment modal
    function closeRiderAssignmentModal() {
        document.getElementById('riderModal').classList.add('hidden');
    }

    // Show tracking input field
    function showTrackingInput(orderId) {
        if (orderId) currentOrder = { id: orderId };
        document.getElementById('trackingInput').classList.remove('hidden');
        document.getElementById('addTrackingBtn').classList.add('hidden');
    }

    // Save tracking number
    function saveTrackingNumber() {
        if (!currentOrder) return;

        const trackingNumber = document.getElementById('trackingNumberInput').value.trim();
        if (!trackingNumber) {
            alert('Please enter a valid tracking number');
            return;
        }

        fetch(`/vendor/orders/${currentOrder.id}/track`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ delivery_code: trackingNumber })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalTrackingStatus').textContent = `Delivery Code: ${trackingNumber}`;
                document.getElementById('trackingInput').classList.add('hidden');
                document.getElementById('addTrackingBtn').classList.remove('hidden');
                alert('Tracking number saved successfully');
            } else {
                alert(data.message || 'Failed to save tracking number');
            }
        })
        .catch(error => {
            console.error('Error saving tracking number:', error);
            alert('Failed to save tracking number');
        });
    }

    // Print invoice (stub implementation)
    function printInvoice() {
        if (!currentOrder) {
            alert('No order selected');
            return;
        }
        window.print(); // In a real app, generate a proper invoice PDF
    }

    // Open order modal and fetch order details
    async function openOrderModal(orderId, event) {
        if (event) event.stopPropagation();

        const modal = document.getElementById('orderModal');
        modal.classList.remove('hidden');

        try {
            const response = await fetch(`/vendor/orders/${orderId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': getCsrfToken()
                }
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const data = await response.json();
            if (data.error) throw new Error(data.error);

            populateOrderModal(data);
        } catch (error) {
            console.error('Error fetching order:', error);
            alert(`Error loading order: ${error.message}`);
            closeOrderModal();
        }
    }

    // Populate order modal with data
    function populateOrderModal(data) {
        const order = data.order;
        const orderItems = data.order_items;
        currentOrder = order;

        const elements = {
            modalOrderId: document.getElementById('modalOrderId'),
            modalOrderDate: document.getElementById('modalOrderDate'),
            modalOrderStatus: document.getElementById('modalOrderStatus'),
            modalCustomerName: document.getElementById('modalCustomerName'),
            modalCustomerEmail: document.getElementById('modalCustomerEmail'),
            modalCustomerPhone: document.getElementById('modalCustomerPhone'),
            modalShippingAddress: document.getElementById('modalShippingAddress'),
            modalSubtotal: document.getElementById('modalSubtotal'),
            modalShipping: document.getElementById('modalShipping'),
            modalTax: document.getElementById('modalTax'),
            modalDiscount: document.getElementById('modalDiscount'),
            modalTotal: document.getElementById('modalTotal'),
            modalPaymentMethod: document.getElementById('modalPaymentMethod'),
            modalPaymentStatus: document.getElementById('modalPaymentStatus'),
            modalShippingMethod: document.getElementById('modalShippingMethod'),
            modalDeliveryEstimate: document.getElementById('modalDeliveryEstimate'),
            modalTrackingStatus: document.getElementById('modalTrackingStatus'),
            orderItemsList: document.getElementById('orderItemsList'),
            riderInfo: document.getElementById('riderInfo'),
            orderActionBtn: document.getElementById('orderActionBtn')
        };

        // Basic order info
        elements.modalOrderId.textContent = order.order_number || 'N/A';
        elements.modalOrderDate.textContent = `Placed on ${new Date(order.created_at).toLocaleString()}` || 'N/A';

        // Status badge
        if (elements.modalOrderStatus) {
            elements.modalOrderStatus.textContent = order.status.charAt(0).toUpperCase() + order.status.slice(1);
            elements.modalOrderStatus.className = `px-2 py-1 rounded-full text-xs font-medium ${statusClasses[order.status.toLowerCase()] || 'bg-gray-100 text-gray-800'}`;
        }

        // Customer info
        elements.modalCustomerName.textContent = order.customer_name || 'N/A';
        elements.modalCustomerEmail.textContent = order.email || 'N/A';
        elements.modalCustomerPhone.textContent = order.phone || 'N/A';
        elements.modalShippingAddress.textContent = order.location || 'N/A';

        // Order summary
        elements.modalSubtotal.textContent = `GHC${order.subtotal || 0}`;
        elements.modalShipping.textContent = `GHC${order.delivery_fee || 0}`;
        elements.modalTax.textContent = 'GHC0.00';
        elements.modalDiscount.textContent = 'GHC0.00';
        elements.modalTotal.textContent = `GHC${order.amount || 0}`;

        // Payment info
        elements.modalPaymentMethod.textContent = order.payment_mode === 'cash_on_delivery' ? 'Cash on Delivery' : 'Online Payment';
        elements.modalPaymentStatus.textContent = order.status === 'confirmed' ? 'Confirmed' : 'Pending';

        // Shipping info
        elements.modalShippingMethod.textContent = 'Standard Delivery';
        elements.modalDeliveryEstimate.textContent = '1-3 business days';

        // Rider info
        if (order.rider_id) {
            elements.riderInfo.innerHTML = `
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light flex items-center justify-center">
                    <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-pam-gray">Rider ID: ${order.rider_id}</p>
                    <p class="text-xs text-pam-gray">Assigned</p>
                </div>
            `;
        } else {
            elements.riderInfo.innerHTML = `
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light flex items-center justify-center">
                    <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-pam-gray">Unassigned</p>
                    <p class="text-xs text-pam-gray">Click to assign a rider</p>
                </div>
            `;
        }

        // Tracking info
        elements.modalTrackingStatus.textContent = order.delivery_code ? `Delivery Code: ${order.delivery_code}` : 'No tracking info';

        // Order items
        // In the populateOrderModal function, update the orderItemsList section
if (elements.orderItemsList) {
    elements.orderItemsList.innerHTML = orderItems.map(item => `
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-pam-gray">${item.product_name || 'N/A'}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-pam-gray">${item.sku || '-'}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-pam-gray">GHC${item.price}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-pam-gray">${item.quantity}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right">
                <div class="text-sm text-pam-gray">GHC${item.amount}</div>
            </td>
        </tr>
    `).join('');
}

        // Action button
        if (elements.orderActionBtn) {
            if (order.status === 'confirmed') {
                elements.orderActionBtn.textContent = 'Prepare Order';
                elements.orderActionBtn.className = 'px-4 py-2 bg-pam-green text-white rounded-lg hover:bg-green-600 transition';
                elements.orderActionBtn.onclick = () => processOrderAction(order.id, 'processing');
                elements.orderActionBtn.classList.remove('hidden');
                elements.orderActionBtn.setAttribute('aria-label', 'Prepare order');
            } else if (order.status === 'processing') {
                elements.orderActionBtn.textContent = 'Mark as Shipped';
                elements.orderActionBtn.className = 'px-4 py-2 bg-pam-blue text-white rounded-lg hover:bg-blue-600 transition';
                elements.orderActionBtn.onclick = () => processOrderAction(order.id, 'shipped');
                elements.orderActionBtn.classList.remove('hidden');
                elements.orderActionBtn.setAttribute('aria-label', 'Mark order as shipped');
            } else {
                elements.orderActionBtn.classList.add('hidden');
            }
        }
    }

    // Process order action
    async function processOrderAction(orderId, newStatus) {
        if (!orderId) return;

        const endpoint = newStatus === 'processing' ? 'process' : 
                        newStatus === 'shipped' ? 'ship' : 
                        newStatus === 'delivered' ? 'deliver' : '';

        if (!endpoint) return;

        try {
            const response = await fetch(`/vendor/orders/${orderId}/${endpoint}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();
            if (data.success) {
                alert(`Order status updated to ${newStatus}`);
                window.location.reload();
            } else {
                alert(data.message || 'Failed to update order status');
            }
        } catch (error) {
            console.error('Error updating order status:', error);
            alert('Failed to update order status');
        }
    }

    // Open rider assignment modal and fetch riders
    async function openRiderAssignmentModal() {
        const modal = document.getElementById('riderModal');
        const riderList = document.getElementById('riderList');
        riderList.innerHTML = '<div class="text-center p-4">Loading riders...</div>';

        modal.classList.remove('hidden');

        try {
            const response = await fetch('/vendor/riders', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': getCsrfToken()
                }
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const data = await response.json();
            riderList.innerHTML = data.riders.map(rider => `
                <div class="flex items-center p-2 border border-pam-gray-light rounded-lg hover:bg-pam-gray-light/50 cursor-pointer" 
                     onclick="assignRider('${rider.name}', '${rider.id}', '${rider.avatar}', '${rider.status}')"
                     role="button"
                     aria-label="Assign rider ${rider.name}">
                    <img class="h-8 w-8 rounded-full" src="${rider.avatar}" alt="Rider ${rider.name}">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-pam-gray">${rider.name}</p>
                        <p class="text-xs text-pam-gray">${rider.id} • <span class="${rider.status === 'Available' ? 'text-pam-green' : rider.status === 'On Delivery' ? 'text-yellow-500' : 'text-pam-gray'}">${rider.status}</span></p>
                    </div>
                </div>
            `).join('');
        } catch (error) {
            console.error('Error fetching riders:', error);
            riderList.innerHTML = '<div class="text-center p-4 text-red-500">Failed to load riders</div>';
        }
    }

    // Assign rider
    async function assignRider(name, id, avatar, status) {
        if (!currentOrder) {
            alert('No order selected');
            return;
        }

        try {
            const response = await fetch(`/vendor/orders/${currentOrder.id}/assign-rider`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ rider_id: id })
            });

            const data = await response.json();
            if (data.success) {
                document.getElementById('riderInfo').innerHTML = `
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light flex items-center justify-center">
                        <img class="h-10 w-10 rounded-full" src="${avatar}" alt="Rider ${name}">
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-pam-gray">${name}</p>
                        <p class="text-xs text-pam-gray">${id} • ${status}</p>
                    </div>
                `;
                closeRiderAssignmentModal();
                alert(`Rider ${name} assigned successfully`);
            } else {
                alert(data.message || 'Failed to assign rider');
            }
        } catch (error) {
            console.error('Error assigning rider:', error);
            alert('Failed to assign rider');
        }
    }

    // Unassign rider
    async function unassignRider() {
        if (!currentOrder) {
            alert('No order selected');
            return;
        }

        try {
            const response = await fetch(`/vendor/orders/${currentOrder.id}/unassign-rider`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();
            if (data.success) {
                document.getElementById('riderInfo').innerHTML = `
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light flex items-center justify-center">
                        <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-pam-gray">Unassigned</p>
                        <p class="text-xs text-pam-gray">Click to assign a rider</p>
                    </div>
                `;
                closeRiderAssignmentModal();
                alert('Rider unassigned successfully');
            } else {
                alert(data.message || 'Failed to unassign rider');
            }
        } catch (error) {
            console.error('Error unassigning rider:', error);
            alert('Failed to unassign rider');
        }
    }

    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target === document.getElementById('orderModal')) {
            closeOrderModal();
        }
        if (event.target === document.getElementById('riderModal')) {
            closeRiderAssignmentModal();
        }
    });

    // Prevent table row click from propagating when clicking buttons
    document.querySelectorAll('tbody tr button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
</script>
</x-vendor-nav>