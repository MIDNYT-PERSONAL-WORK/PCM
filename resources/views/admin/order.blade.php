<x-admin-nav>
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-pam-blue">Order Management</h2>
            <p class="text-pam-gray">Track and manage all customer orders</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button class="bg-pam-blue hover:bg-pam-blue-light text-white px-4 py-2 rounded-lg flex items-center transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Create Order
            </button>
        </div>
    </div>

    <!-- Order Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Total Orders</div>
            <div class="text-2xl font-bold text-pam-blue">1,248</div>
            <div class="text-xs text-pam-green flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                8% from last week
            </div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Pending</div>
            <div class="text-2xl font-bold text-pam-blue">47</div>
            <div class="text-xs text-pam-gray">Requires action</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">In Transit</div>
            <div class="text-2xl font-bold text-pam-blue">182</div>
            <div class="text-xs text-pam-gray">Active shipments</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Delivered</div>
            <div class="text-2xl font-bold text-pam-blue">1,019</div>
            <div class="text-xs text-pam-green flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                12% from last week
            </div>
        </div>
    </div>

    <!-- Filter and Search Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
        <div class="flex items-center space-x-2">
            <button class="px-3 py-1 bg-pam-blue text-white rounded-lg text-sm">All</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Pending</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Processing</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">In Transit</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Delivered</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Cancelled</button>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <input type="text" placeholder="Search orders..." class="w-full pl-10 pr-4 py-2 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                <div class="absolute left-3 top-2.5 text-pam-gray">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            <button class="p-2 border border-pam-gray-light rounded-lg hover:bg-pam-gray-light/50">
                <svg class="w-5 h-5 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-pam-gray-light">
            <thead class="bg-pam-gray-light">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Order ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Customer</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Vendor</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Items</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Rider</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Total</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-pam-gray uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pam-gray-light">
                <!-- Order 1 - Pending -->
                <tr class="hover:bg-pam-gray-light/50 cursor-pointer" onclick="openOrderModal('ORD-2023-00142')">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-pam-blue">ORD-2023-00142</div>
                        <div class="text-xs text-pam-gray">15 Jan 2023, 10:30 AM</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Sarah Johnson</div>
                        <div class="text-xs text-pam-gray">sarah.johnson@example.com</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Speedy Logistics</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">3 items</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-pam-gray-light flex items-center justify-center">
                                <svg class="h-4 w-4 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="ml-2 text-sm text-pam-gray">Unassigned</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-pam-blue">$247.50</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" onclick="event.stopPropagation()">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3" onclick="openOrderModal('ORD-2023-00142')">View</button>
                        <button class="text-pam-green hover:text-green-700">Process</button>
                    </td>
                </tr>

                <!-- Order 2 - Processing -->
                <tr class="hover:bg-pam-gray-light/50 cursor-pointer" onclick="openOrderModal('ORD-2023-00141')">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-pam-blue">ORD-2023-00141</div>
                        <div class="text-xs text-pam-gray">15 Jan 2023, 9:15 AM</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Michael Chen</div>
                        <div class="text-xs text-pam-gray">michael.chen@example.com</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">City Warehousing</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">5 items</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Processing</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-6 w-6 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Rider">
                            <div class="ml-2 text-sm text-pam-gray">John D.</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-pam-blue">$389.75</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" onclick="event.stopPropagation()">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3" onclick="openOrderModal('ORD-2023-00141')">View</button>
                        <button class="text-pam-green hover:text-green-700">Ship</button>
                    </td>
                </tr>

                <!-- Order 3 - In Transit -->
                <tr class="hover:bg-pam-gray-light/50 cursor-pointer" onclick="openOrderModal('ORD-2023-00140')">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-pam-blue">ORD-2023-00140</div>
                        <div class="text-xs text-pam-gray">14 Jan 2023, 2:45 PM</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Emma Rodriguez</div>
                        <div class="text-xs text-pam-gray">emma.rodriguez@example.com</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Express Parcels</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">2 items</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">In Transit</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-6 w-6 rounded-full" src="https://randomuser.me/api/portraits/men/22.jpg" alt="Rider">
                            <div class="ml-2 text-sm text-pam-gray">Robert M.</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-pam-blue">$156.20</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" onclick="event.stopPropagation()">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3" onclick="openOrderModal('ORD-2023-00140')">View</button>
                        <button class="text-pam-green hover:text-green-700">Track</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-pam-gray">
            Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">1,248</span> orders
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50 disabled:opacity-50" disabled>
                Previous
            </button>
            <button class="px-3 py-1 border border-pam-blue-light bg-pam-blue-light text-white rounded-lg">
                1
            </button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50">
                2
            </button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50">
                3
            </button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50">
                Next
            </button>
        </div>
    </div>
</div>

<!-- Order Detail Modal -->
<div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-bold text-pam-blue">Order #<span id="modalOrderId">ORD-2023-00142</span></h3>
                    <p class="text-sm text-pam-gray" id="modalOrderDate">Placed on 15 Jan 2023, 10:30 AM</p>
                </div>
                <div class="flex items-center space-x-2">
                    <span id="modalOrderStatus" class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Pending</span>
                    <button onclick="closeOrderModal()" class="text-pam-gray hover:text-pam-blue">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-pam-gray" id="modalCustomerName">Sarah Johnson</p>
                            <p class="text-xs text-pam-gray" id="modalCustomerEmail">sarah.johnson@example.com</p>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-pam-gray-light/50">
                        <h4 class="font-medium text-pam-blue mb-2">Shipping Address</h4>
                        <p class="text-sm text-pam-gray" id="modalShippingAddress">123 Main Street, Apt 4B, New York, NY 10001, United States</p>
                        <div class="mt-2 flex items-center text-sm text-pam-blue-light">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span id="modalCustomerPhone">(555) 123-4567</span>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="bg-pam-gray-light rounded-lg p-4">
                    <h4 class="font-medium text-pam-blue mb-2">Order Summary</h4>
                    <div class="flex justify-between text-sm text-pam-gray mb-1">
                        <span>Subtotal</span>
                        <span id="modalSubtotal">$225.00</span>
                    </div>
                    <div class="flex justify-between text-sm text-pam-gray mb-1">
                        <span>Shipping</span>
                        <span id="modalShipping">$22.50</span>
                    </div>
                    <div class="flex justify-between text-sm text-pam-gray mb-1">
                        <span>Tax</span>
                        <span id="modalTax">$0.00</span>
                    </div>
                    <div class="mt-3 pt-3 border-t border-pam-gray-light/50 flex justify-between font-medium text-pam-blue">
                        <span>Total</span>
                        <span id="modalTotal">$247.50</span>
                    </div>
                    <div class="mt-3 pt-3 border-t border-pam-gray-light/50">
                        <h4 class="font-medium text-pam-blue mb-2">Payment Method</h4>
                        <p class="text-sm text-pam-gray" id="modalPaymentMethod">Credit Card (VISA •••• 4242)</p>
                        <p class="text-sm text-pam-gray" id="modalPaymentDate">Paid on 15 Jan 2023, 10:31 AM</p>
                    </div>
                </div>
                
                <!-- Shipping & Rider Info -->
                <div class="bg-pam-gray-light rounded-lg p-4">
                    <h4 class="font-medium text-pam-blue mb-2">Shipping Information</h4>
                    <p class="text-sm text-pam-gray" id="modalVendor">Speedy Logistics</p>
                    <p class="text-sm text-pam-gray" id="modalShippingMethod">Standard Shipping</p>
                    <p class="text-sm text-pam-gray" id="modalDeliveryEstimate">Estimated delivery: 18 Jan 2023</p>
                    
                    <div class="mt-3 pt-3 border-t border-pam-gray-light/50">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-medium text-pam-blue">Assigned Rider</h4>
                            <button onclick="openRiderAssignmentModal()" class="text-xs text-pam-blue-light hover:text-pam-blue">Change</button>
                        </div>
                        <div id="riderInfo" class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light flex items-center justify-center">
                                <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <p class="text-sm text-pam-gray" id="modalTrackingStatus">Not yet shipped</p>
                        <div id="trackingInput" class="mt-2 hidden">
                            <div class="flex">
                                <input type="text" placeholder="Enter tracking number" class="flex-1 border border-pam-gray-light rounded-l-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                                <button class="bg-pam-blue-light text-white px-3 py-2 rounded-r-lg hover:bg-pam-blue transition">Save</button>
                            </div>
                        </div>
                        <button id="addTrackingBtn" class="mt-2 text-sm text-pam-blue-light hover:text-pam-blue" onclick="showTrackingInput()">Add Tracking Number</button>
                    </div>
                </div>
            </div>
            
            <!-- Order Items -->
            <div class="mb-6">
                <h4 class="font-medium text-pam-blue mb-3">Order Items</h4>
                <div class="border border-pam-gray-light rounded-lg overflow-hidden">
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
                        <tbody class="bg-white divide-y divide-pam-gray-light" id="orderItemsList">
                            <!-- Items will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Order Actions -->
            <div class="flex justify-between items-center pt-4 border-t border-pam-gray-light">
                <div>
                    <button class="text-sm text-pam-gray hover:text-pam-blue flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Print Invoice
                    </button>
                </div>
                <div class="flex space-x-3">
                    <button onclick="closeOrderModal()" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition">Close</button>
                    <button id="orderActionBtn" class="px-4 py-2 bg-pam-green text-white rounded-lg hover:bg-green-600 transition">Process Order</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rider Assignment Modal -->
<div id="riderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-pam-blue">Assign Rider</h3>
                <button onclick="closeRiderAssignmentModal()" class="text-pam-gray hover:text-pam-blue">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-pam-gray mb-2">Available Riders</label>
                <div class="space-y-2 max-h-60 overflow-y-auto">
                    <!-- Rider 1 -->
                    <div class="flex items-center p-2 border border-pam-gray-light rounded-lg hover:bg-pam-gray-light/50 cursor-pointer" onclick="assignRider('John Doe', 'RDR-001', 'https://randomuser.me/api/portraits/men/32.jpg', 'Available')">
                        <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Rider">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-pam-gray">John Doe</p>
                            <p class="text-xs text-pam-gray">RDR-001 • <span class="text-pam-green">Available</span></p>
                        </div>
                    </div>
                    <!-- Rider 2 -->
                    <div class="flex items-center p-2 border border-pam-gray-light rounded-lg hover:bg-pam-gray-light/50 cursor-pointer" onclick="assignRider('Robert Miles', 'RDR-002', 'https://randomuser.me/api/portraits/men/22.jpg', 'On Delivery')">
                        <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/men/22.jpg" alt="Rider">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-pam-gray">Robert Miles</p>
                            <p class="text-xs text-pam-gray">RDR-002 • <span class="text-yellow-500">On Delivery</span></p>
                        </div>
                    </div>
                    <!-- Rider 3 -->
                    <div class="flex items-center p-2 border border-pam-gray-light rounded-lg hover:bg-pam-gray-light/50 cursor-pointer" onclick="assignRider('Sarah Connor', 'RDR-003', 'https://randomuser.me/api/portraits/women/44.jpg', 'Available')">
                        <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Rider">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-pam-gray">Sarah Connor</p>
                            <p class="text-xs text-pam-gray">RDR-003 • <span class="text-pam-green">Available</span></p>
                        </div>
                    </div>
                    <!-- Rider 4 -->
                    <div class="flex items-center p-2 border border-pam-gray-light rounded-lg hover:bg-pam-gray-light/50 cursor-pointer" onclick="assignRider('Mike Johnson', 'RDR-004', 'https://randomuser.me/api/portraits/men/41.jpg', 'Off Duty')">
                        <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/men/41.jpg" alt="Rider">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-pam-gray">Mike Johnson</p>
                            <p class="text-xs text-pam-gray">RDR-004 • <span class="text-pam-gray">Off Duty</span></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button onclick="closeRiderAssignmentModal()" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition">Cancel</button>
                <button onclick="unassignRider()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Unassign</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Sample order data
    const orders = {
        'ORD-2023-00142': {
            date: '15 Jan 2023, 10:30 AM',
            status: 'Pending',
            customer: {
                name: 'Sarah Johnson',
                email: 'sarah.johnson@example.com',
                phone: '(555) 123-4567',
                address: '123 Main Street, Apt 4B, New York, NY 10001, United States'
            },
            vendor: 'Speedy Logistics',
            shippingMethod: 'Standard Shipping',
            deliveryEstimate: '18 Jan 2023',
            payment: {
                method: 'Credit Card (VISA •••• 4242)',
                date: '15 Jan 2023, 10:31 AM'
            },
            rider: {
                assigned: false,
                name: '',
                id: '',
                photo: '',
                status: ''
            },
            tracking: {
                number: '',
                status: 'Not yet shipped'
            },
            summary: {
                subtotal: '$225.00',
                shipping: '$22.50',
                tax: '$0.00',
                total: '$247.50'
            },
            items: [
                { name: 'Wireless Bluetooth Headphones', sku: 'SKU-HE-1001', price: '$99.00', qty: 1, total: '$99.00' },
                { name: 'Smartphone Case', sku: 'SKU-CA-2005', price: '$25.00', qty: 2, total: '$50.00' },
                { name: 'Screen Protector', sku: 'SKU-SP-3012', price: '$15.00', qty: 1, total: '$15.00' }
            ],
            action: 'Process Order',
            actionClass: 'bg-pam-green hover:bg-green-600'
        },
        'ORD-2023-00141': {
            date: '15 Jan 2023, 9:15 AM',
            status: 'Processing',
            customer: {
                name: 'Michael Chen',
                email: 'michael.chen@example.com',
                phone: '(555) 987-6543',
                address: '456 Oak Avenue, Suite 200, Los Angeles, CA 90012, United States'
            },
            vendor: 'City Warehousing',
            shippingMethod: 'Express Shipping',
            deliveryEstimate: '17 Jan 2023',
            payment: {
                method: 'PayPal',
                date: '15 Jan 2023, 9:16 AM'
            },
            rider: {
                assigned: true,
                name: 'John D.',
                id: 'RDR-001',
                photo: 'https://randomuser.me/api/portraits/men/32.jpg',
                status: 'Available'
            },
            tracking: {
                number: '',
                status: 'Preparing for shipment'
            },
            summary: {
                subtotal: '$350.00',
                shipping: '$39.75',
                tax: '$0.00',
                total: '$389.75'
            },
            items: [
                { name: 'Laptop', sku: 'SKU-LP-5001', price: '$299.00', qty: 1, total: '$299.00' },
                { name: 'Laptop Sleeve', sku: 'SKU-LS-6002', price: '$25.00', qty: 1, total: '$25.00' },
                { name: 'Wireless Mouse', sku: 'SKU-WM-7003', price: '$15.00', qty: 1, total: '$15.00' },
                { name: 'Keyboard', sku: 'SKU-KB-8004', price: '$45.00', qty: 1, total: '$45.00' },
                { name: 'Mouse Pad', sku: 'SKU-MP-9005', price: '$8.00', qty: 2, total: '$16.00' }
            ],
            action: 'Ship Order',
            actionClass: 'bg-pam-blue hover:bg-blue-600'
        },
        'ORD-2023-00140': {
            date: '14 Jan 2023, 2:45 PM',
            status: 'In Transit',
            customer: {
                name: 'Emma Rodriguez',
                email: 'emma.rodriguez@example.com',
                phone: '(555) 456-7890',
                address: '789 Pine Road, Chicago, IL 60601, United States'
            },
            vendor: 'Express Parcels',
            shippingMethod: 'Standard Shipping',
            deliveryEstimate: '16 Jan 2023',
            payment: {
                method: 'Credit Card (MC •••• 5678)',
                date: '14 Jan 2023, 2:46 PM'
            },
            rider: {
                assigned: true,
                name: 'Robert M.',
                id: 'RDR-002',
                photo: 'https://randomuser.me/api/portraits/men/22.jpg',
                status: 'On Delivery'
            },
            tracking: {
                number: 'EXP123456789',
                status: 'In transit - Out for delivery'
            },
            summary: {
                subtotal: '$140.00',
                shipping: '$16.20',
                tax: '$0.00',
                total: '$156.20'
            },
            items: [
                { name: 'Smart Watch', sku: 'SKU-SW-4006', price: '$120.00', qty: 1, total: '$120.00' },
                { name: 'Watch Band', sku: 'SKU-WB-5007', price: '$20.00', qty: 1, total: '$20.00' }
            ],
            action: 'Track Order',
            actionClass: 'bg-purple-500 hover:bg-purple-600'
        }
    };

    // Order modal functions
    function openOrderModal(orderId) {
        const order = orders[orderId];
        if (!order) return;
        
        // Set basic order info
        document.getElementById('modalOrderId').textContent = orderId;
        document.getElementById('modalOrderDate').textContent = `Placed on ${order.date}`;
        document.getElementById('modalOrderStatus').textContent = order.status;
        
        // Set status badge color
        const statusBadge = document.getElementById('modalOrderStatus');
        statusBadge.className = 'px-2 py-1 rounded-full text-xs font-medium';
        if (order.status === 'Pending') {
            statusBadge.classList.add('bg-yellow-100', 'text-yellow-800');
        } else if (order.status === 'Processing') {
            statusBadge.classList.add('bg-blue-100', 'text-blue-800');
        } else if (order.status === 'In Transit') {
            statusBadge.classList.add('bg-purple-100', 'text-purple-800');
        } else if (order.status === 'Delivered') {
            statusBadge.classList.add('bg-green-100', 'text-green-800');
        } else if (order.status === 'Cancelled') {
            statusBadge.classList.add('bg-red-100', 'text-red-800');
        }
        
        // Set customer info
        document.getElementById('modalCustomerName').textContent = order.customer.name;
        document.getElementById('modalCustomerEmail').textContent = order.customer.email;
        document.getElementById('modalCustomerPhone').textContent = order.customer.phone;
        document.getElementById('modalShippingAddress').textContent = order.customer.address;
        
        // Set vendor and shipping info
        document.getElementById('modalVendor').textContent = order.vendor;
        document.getElementById('modalShippingMethod').textContent = order.shippingMethod;
        document.getElementById('modalDeliveryEstimate').textContent = `Estimated delivery: ${order.deliveryEstimate}`;
        
        // Set payment info
        document.getElementById('modalPaymentMethod').textContent = order.payment.method;
        document.getElementById('modalPaymentDate').textContent = `Paid on ${order.payment.date}`;
        
        // Set order summary
        document.getElementById('modalSubtotal').textContent = order.summary.subtotal;
        document.getElementById('modalShipping').textContent = order.summary.shipping;
        document.getElementById('modalTax').textContent = order.summary.tax;
        document.getElementById('modalTotal').textContent = order.summary.total;
        
        // Set rider info
        const riderInfo = document.getElementById('riderInfo');
        if (order.rider.assigned) {
            riderInfo.innerHTML = `
                <img class="h-10 w-10 rounded-full" src="${order.rider.photo}" alt="Rider">
                <div class="ml-3">
                    <p class="text-sm font-medium text-pam-gray">${order.rider.name}</p>
                    <p class="text-xs text-pam-gray">${order.rider.id} • <span class="${order.rider.status === 'Available' ? 'text-pam-green' : order.rider.status === 'On Delivery' ? 'text-yellow-500' : 'text-pam-gray'}">${order.rider.status}</span></p>
                </div>
            `;
        } else {
            riderInfo.innerHTML = `
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light flex items-center justify-center">
                    <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-pam-gray">Unassigned</p>
                    <p class="text-xs text-pam-gray">Click to assign a rider</p>
                </div>
            `;
        }
        
        // Set tracking info
        document.getElementById('modalTrackingStatus').textContent = order.tracking.status;
        const trackingInput = document.getElementById('trackingInput');
        const addTrackingBtn = document.getElementById('addTrackingBtn');
        
        if (order.tracking.number) {
            trackingInput.classList.add('hidden');
            addTrackingBtn.classList.add('hidden');
            document.getElementById('modalTrackingStatus').textContent = `Tracking #: ${order.tracking.number} - ${order.tracking.status}`;
        } else {
            trackingInput.classList.add('hidden');
            addTrackingBtn.classList.remove('hidden');
        }
        
        // Set order items
        const itemsList = document.getElementById('orderItemsList');
        itemsList.innerHTML = '';
        order.items.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-pam-gray">${item.name}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-pam-gray">${item.sku}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-pam-gray">${item.price}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-pam-gray">${item.qty}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <div class="text-sm text-pam-gray">${item.total}</div>
                </td>
            `;
            itemsList.appendChild(row);
        });
        
        // Set action button
        const actionBtn = document.getElementById('orderActionBtn');
        actionBtn.textContent = order.action;
        actionBtn.className = `px-4 py-2 text-white rounded-lg hover:bg-green-600 transition ${order.actionClass}`;
        
        // Show modal
        document.getElementById('orderModal').classList.remove('hidden');
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
    }

    // Rider assignment functions
    function openRiderAssignmentModal() {
        document.getElementById('riderModal').classList.remove('hidden');
    }

    function closeRiderAssignmentModal() {
        document.getElementById('riderModal').classList.add('hidden');
    }

    function assignRider(name, id, photo, status) {
        const riderInfo = document.getElementById('riderInfo');
        riderInfo.innerHTML = `
            <img class="h-10 w-10 rounded-full" src="${photo}" alt="Rider">
            <div class="ml-3">
                <p class="text-sm font-medium text-pam-gray">${name}</p>
                <p class="text-xs text-pam-gray">${id} • <span class="${status === 'Available' ? 'text-pam-green' : status === 'On Delivery' ? 'text-yellow-500' : 'text-pam-gray'}">${status}</span></p>
            </div>
        `;
        closeRiderAssignmentModal();
        
        // In a real app, you would save this assignment to your backend
        alert(`Rider ${name} assigned to this order`);
    }

    function unassignRider() {
        const riderInfo = document.getElementById('riderInfo');
        riderInfo.innerHTML = `
            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light flex items-center justify-center">
                <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-pam-gray">Unassigned</p>
                <p class="text-xs text-pam-gray">Click to assign a rider</p>
            </div>
        `;
        closeRiderAssignmentModal();
        
        // In a real app, you would remove this assignment from your backend
        alert('Rider unassigned from this order');
    }

    // Tracking functions
    function showTrackingInput() {
        document.getElementById('trackingInput').classList.remove('hidden');
        document.getElementById('addTrackingBtn').classList.add('hidden');
    }

    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        const orderModal = document.getElementById('orderModal');
        const riderModal = document.getElementById('riderModal');
        
        if (event.target === orderModal) {
            closeOrderModal();
        }
        
        if (event.target === riderModal) {
            closeRiderAssignmentModal();
        }
    });

    // Prevent table row click from propagating to document
    document.querySelectorAll('tbody tr').forEach(row => {
        row.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
</script>
</x-admin-nav>