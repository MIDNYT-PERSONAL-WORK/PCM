<x-operator-nav>
 


    <div class="flex h-screen">
        <!-- Sidebar (same as your existing dashboard) -->
       
        
        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-3 bg-white border-b border-pam-gray-light">
                 @if (session('error'))
                    <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded p-3 flex items-center justify-between">
                        <span>{{ session('error') }}</span>
                        <button type="button" class="ml-4 text-red-400 hover:text-red-600 focus:outline-none" onclick="this.parentElement.style.display='none'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded p-3 flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="ml-4 text-green-400 hover:text-green-600 focus:outline-none" onclick="this.parentElement.style.display='none'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-pam-gray"> Orders</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="px-4 py-2 text-sm border border-pam-gray-light rounded-lg bg-pam-blue-light text-white hover:bg-pam-blue">
                        <svg class="w-4 h-4 inline mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        New Order
                    </button>
                </div>
            </div>
            
            <!-- Main content area -->
            <div class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Total  Orders</p>
                                <p class="text-2xl font-semibold text-pam-blue">{{ $TotalOrders }}</p>
                                <p class="text-xs text-pam-gray">All  orders</p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-blue/10 text-pam-blue">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Today's Orders</p>
                                <p class="text-2xl font-semibold text-pam-blue">{{ $totalToday }}</p>
                                <p class="text-xs text-pam-gray">Created today</p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-green/10 text-pam-green">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Aging Drafts</p>
                                <p class="text-2xl font-semibold text-pam-blue">{{ $olderThan3Days }}</p>
                                <p class="text-xs text-pam-gray">Older than 3 days</p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-yellow/10 text-pam-yellow">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Avg. Items</p>
                                <p class="text-2xl font-semibold text-pam-blue">{{ $avgProcessingTime }}</p>
                                <p class="text-xs text-pam-gray">Per draft order</p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-blue-light/10 text-pam-blue-light">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts and Filters -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Drafts Over Time Chart -->
                    <div class="lg:col-span-2 bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-pam-gray">Drafts Created Last 14 Days</h2>
                            <select class="text-sm border border-pam-gray-light rounded-lg bg-white px-2 py-1">
                                <option>Last 7 days</option>
                                <option selected>Last 14 days</option>
                                <option>Last 30 days</option>
                                <option>Last 90 days</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="draftsChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Draft Status Breakdown -->
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <h2 class="text-lg font-medium text-pam-gray mb-4">Order Status</h2>
                        <div class="h-64">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Draft Orders Table -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <h2 class="text-lg font-medium text-pam-gray mb-2 md:mb-0">All  Orders</h2>
                        <div class="flex space-x-2">
                            <div class="relative">
                                <input type="text" placeholder="Search drafts..." class="pl-8 pr-4 py-2 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition w-full md:w-64">
                                <div class="absolute left-3 top-2.5 text-pam-gray">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            <select class="text-sm border border-pam-gray-light rounded-lg bg-white px-3 py-2">
                                <option>All Vendors</option>
                                <option>Fresh Groceries</option>
                                <option>ElectroHub</option>
                                <option>Fashion Boutique</option>
                                <option>Book Haven</option>
                            </select>
                            <select class="text-sm border border-pam-gray-light rounded-lg bg-white px-3 py-2">
                                <option>Sort: Newest First</option>
                                <option>Oldest First</option>
                                <option>Most Items</option>
                                <option>Highest Value</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-pam-gray-light">
                            <thead class="bg-pam-gray-light">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Order #</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Customer</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Vendor</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Items</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Created</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-pam-gray uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-pam-gray-light">
                                @foreach($AllOrders as $order)
                                <tr class="hover:bg-pam-gray-light/50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-pam-blue">ORD-{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-pam-gray">
                                        {{ $order->customer_name }}<br>
                                        <span class="text-xs text-black">{{ $order->phone }}</span>
                                    </td>
                                     <td class="px-6 py-4 whitespace-nowrap text-sm text-pam-gray">
                                        @if($order->product)
                                            {{ $order->product->vendor->name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                   <td class="px-6 py-4 whitespace-nowrap text-sm text-pam-gray">

                                            {{ $order->product->name }} ({{ $order->quantity }})<br>

                                    </td>
                                     <td class="px-6 py-4 whitespace-nowrap text-sm text-pam-gray">
                                        GHC{{ number_format($order->sum('amount'), 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-pam-gray">
                                        {{ $order->created_at->diffForHumans() }}<br>
                                        <span class="text-xs text-black">
                                            {{ $order->created_at->format('M j, Y g:i a') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = [
                                                'draft' => 'bg-pam-gray-100 text-pam-gray-800',
                                                'pending_call' => 'bg-pam-yellow-100 text-pam-yellow-800',
                                                'processing' => 'bg-pam-blue-100 text-pam-blue-800',
                                                'completed' => 'bg-pam-green-100 text-pam-green-800'
                                            ];
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$order->status] ?? 'bg-pam-gray-100 text-pam-gray-800' }}">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="" class="text-pam-blue-light hover:text-pam-blue mr-3">Edit</a>
                                    
                                    <form action="{{ route('orders.confirm', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-pam-green hover:text-pam-green">Confirm</button>
                                    </form>
                                </td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="flex items-center justify-between px-6 py-3 border-t border-pam-gray-light">
                        {{ $AllOrders->links() }}
                    </div>
                    
                   
                </div>
            </div>
        </div>
    </div>

    <script>
        // Drafts Over Time Chart
        const draftsCtx = document.getElementById('draftsChart').getContext('2d');
        const draftsChart = new Chart(draftsCtx, {
            type: 'line',
            data: {
                labels: ['Jan 1', 'Jan 2', 'Jan 3', 'Jan 4', 'Jan 5', 'Jan 6', 'Jan 7', 'Jan 8', 'Jan 9', 'Jan 10', 'Jan 11', 'Jan 12', 'Jan 13', 'Jan 14'],
                datasets: [{
                    label: 'Drafts Created',
                    data: [3, 5, 2, 6, 4, 7, 5, 8, 6, 9, 7, 10, 8, 12],
                    backgroundColor: 'rgba(59, 130, 246, 0.05)',
                    borderColor: '#3b82f6',
                    borderWidth: 2,
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 2
                        }
                    }
                }
            }
        });

        // Status Breakdown Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['New', 'In Progress', 'Expiring Soon', 'Pending Customer'],
                datasets: [{
                    data: [18, 22, 5, 2],
                    backgroundColor: [
                        '#f59e0b',
                        '#3b82f6',
                        '#ef4444',
                        '#6b7280'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                },
                cutout: '70%'
            }
        });
    </script>



</x-operator-nav>