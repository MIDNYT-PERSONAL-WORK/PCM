<x-admin-nav>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | PAM Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pam-blue': '#1e3a8a',
                        'pam-blue-light': '#3b82f6',
                        'pam-green': '#10b981',
                        'pam-gray': '#6b7280',
                        'pam-red': '#ef4444',
                        'pam-orange': '#f97316',
                        'pam-gray-light': '#f3f4f6',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="font-sans bg-pam-gray-light">
   
         
            <div class="flex-1 overflow-y-auto p-4 md:p-6">
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
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Total Orders</p>
                                <p class="text-2xl font-semibold text-pam-blue">{{$TotalOrder}}</p>
                                <p class="text-xs text-pam-green flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    12.5% from last week
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
                                <p class="text-sm font-medium text-pam-gray">Active Vendors</p>
                                <p class="text-2xl font-semibold text-pam-blue">{{$TotalVendor}}</p>
                                <p class="text-xs text-pam-green flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    5.2% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-green/10 text-pam-green">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Riders Online</p>
                                <p class="text-2xl font-semibold text-pam-blue">{{$TotalRider}}</p>
                                <p class="text-xs text-pam-gray">Out of 52 total</p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-blue/10 text-pam-blue">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Revenue</p>
                                <p class="text-2xl font-semibold text-pam-blue">$24,760</p>
                                <p class="text-xs text-pam-green flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    8.3% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-gray/10 text-pam-gray">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                
                <!-- Recent Orders & Top Vendors -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Orders -->
                    <div class="lg:col-span-2 bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-pam-gray">Recent Orders</h2>
                            <a href="#" class="text-sm font-medium text-pam-blue-light hover:text-pam-blue">View All</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-pam-gray-light">
                                <thead class="bg-pam-gray-light/50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Order ID</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Vendor</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-pam-gray-light">
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7841</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">Fresh Groceries</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pam-green/10 text-pam-green">Delivered</span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">15 Jun 2023</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">$124.50</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7840</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">ElectroHub</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pam-blue-light/10 text-pam-blue-light">In Transit</span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">15 Jun 2023</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">$89.99</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7839</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">Fashion Boutique</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">14 Jun 2023</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">$245.75</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7838</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">Book Haven</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pam-green/10 text-pam-green">Delivered</span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">14 Jun 2023</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">$32.99</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7837</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">Home Essentials</td>
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
                    
                    <!-- Top Vendors -->
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-pam-gray">Top Vendors</h2>
                            <a href="#" class="text-sm font-medium text-pam-blue-light hover:text-pam-blue">View All</a>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-blue-light/10 text-pam-blue-light flex items-center justify-center font-medium">1</div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-pam-gray">ElectroHub</p>
                                    <p class="text-xs text-pam-gray">124 orders this month</p>
                                </div>
                                <div class="ml-auto text-sm font-medium text-pam-blue">$12,456</div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-blue-light/10 text-pam-blue-light flex items-center justify-center font-medium">2</div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-pam-gray">Fresh Groceries</p>
                                    <p class="text-xs text-pam-gray">98 orders this month</p>
                                </div>
                                <div class="ml-auto text-sm font-medium text-pam-blue">$9,845</div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-blue-light/10 text-pam-blue-light flex items-center justify-center font-medium">3</div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-pam-gray">Fashion Boutique</p>
                                    <p class="text-xs text-pam-gray">87 orders this month</p>
                                </div>
                                <div class="ml-auto text-sm font-medium text-pam-blue">$8,732</div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light text-pam-gray flex items-center justify-center font-medium">4</div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-pam-gray">Book Haven</p>
                                    <p class="text-xs text-pam-gray">76 orders this month</p>
                                </div>
                                <div class="ml-auto text-sm font-medium text-pam-blue">$5,987</div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light text-pam-gray flex items-center justify-center font-medium">5</div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-pam-gray">Home Essentials</p>
                                    <p class="text-xs text-pam-gray">65 orders this month</p>
                                </div>
                                <div class="ml-auto text-sm font-medium text-pam-blue">$5,432</div>
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
                    data: [120, 190, 170, 210, 240, 180, 150],
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
                    data: [15000, 18000, 21000, 19000, 23000, 24760],
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
</html>
</x-admin-nav>