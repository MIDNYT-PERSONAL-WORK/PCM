<x-vendor-nav>

<div class="flex h-screen">
        <!-- Sidebar -->
        
        
        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
      

            <!-- Main content area -->
            <div class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Total Orders</p>
                                <p class="text-2xl font-semibold text-pam-blue">248</p>
                                <p class="text-xs text-pam-green flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    8.5% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-blue-light/10 text-pam-blue-light">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Revenue</p>
                                <p class="text-2xl font-semibold text-pam-blue">$12,456</p>
                                <p class="text-xs text-pam-green flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    10.2% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-green/10 text-pam-green">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Avg. Order Value</p>
                                <p class="text-2xl font-semibold text-pam-blue">$50.22</p>
                                <p class="text-xs text-pam-gray">From all orders</p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-blue/10 text-pam-blue">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Pending Orders</p>
                                <p class="text-2xl font-semibold text-pam-blue">18</p>
                                <p class="text-xs text-pam-gray">Waiting for dispatch</p>
                            </div>
                            <div class="p-3 rounded-lg bg-yellow-100/10 text-yellow-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Orders Chart -->
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-pam-gray">Weekly Orders</h2>
                            <select class="text-sm border border-pam-gray-light rounded-lg px-2 py-1 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none">
                                <option>This Week</option>
                                <option>Last Week</option>
                                <option>This Month</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Revenue Chart -->
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-pam-gray">Revenue Overview</h2>
                            <select class="text-sm border border-pam-gray-light rounded-lg px-2 py-1 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none">
                                <option>Last 7 Days</option>
                                <option>Last 30 Days</option>
                                <option>This Year</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Orders -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-pam-gray">Recent Orders</h2>
                        <a href="#" class="text-sm font-medium text-pam-blue-light hover:text-pam-blue">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-pam-gray-light">
                            <thead class="bg-pam-gray-light/50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Order ID</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Customer</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-pam-gray-light">
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7841</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">John Smith</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pam-green/10 text-pam-green">Delivered</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">15 Jun 2023</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">$124.50</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7840</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">Sarah Johnson</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pam-blue-light/10 text-pam-blue-light">In Transit</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">15 Jun 2023</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">$89.99</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7839</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">Michael Brown</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">14 Jun 2023</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">$245.75</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7838</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">Emily Davis</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pam-green/10 text-pam-green">Delivered</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">14 Jun 2023</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">$32.99</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7837</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">Robert Wilson</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">13 Jun 2023</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">$156.20</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Orders Chart
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ordersCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Orders',
                    data: [12, 19, 17, 21, 24, 18, 15],
                    backgroundColor: 'rgba(59, 130, 246, 0.05)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    tension: 0.3,
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
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Revenue',
                    data: [5000, 8000, 6000, 9000, 11000, 12456],
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 1
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
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</body>
    


</x-vendor-nav>