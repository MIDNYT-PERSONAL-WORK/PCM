<x-rider-nav>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-600">Earnings & Cashout</h1>
                <div class="flex items-center space-x-4">
                    <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Notifications</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <div class="flex items-center">
                        <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <span class="ml-2 text-sm font-medium text-gray-700">John Rider</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Balance Summary -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="text-center md:text-left mb-4 md:mb-0">
                            <h3 class="text-lg font-medium text-blue-100">Available Balance</h3>
                            <p class="mt-1 text-3xl font-semibold text-white">GH₵1,245.50</p>
                            <p class="mt-1 text-blue-200">Last cashout: 2 days ago</p>
                        </div>
                        <button class="px-6 py-3 bg-white text-blue-600 font-medium rounded-lg shadow-sm hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition">
                            Cash Out Now
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings Overview -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Earnings Overview</h3>
                    <p class="mt-1 text-sm text-gray-500">Your earnings breakdown for this week</p>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Base Earnings -->
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Base Earnings</p>
                                    <p class="text-2xl font-semibold text-gray-900">GH₵845.00</p>
                                    <p class="text-xs text-blue-600 mt-1">From 42 deliveries</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tips -->
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Tips</p>
                                    <p class="text-2xl font-semibold text-gray-900">GH₵275.50</p>
                                    <p class="text-xs text-green-600 mt-1">From 28 customers</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bonuses -->
                        <div class="bg-purple-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Bonuses</p>
                                    <p class="text-2xl font-semibold text-gray-900">GH₵125.00</p>
                                    <p class="text-xs text-purple-600 mt-1">On-time delivery bonus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings Chart -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Weekly Earnings</h3>
                            <p class="mt-1 text-sm text-gray-500">Your earnings over the last 4 weeks</p>
                        </div>
                        <div class="mt-3 md:mt-0">
                            <select class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option>Last 4 Weeks</option>
                                <option>Last 8 Weeks</option>
                                <option>This Month</option>
                                <option>Last Month</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="h-64">
                        <!-- Chart placeholder - would be replaced with actual chart library -->
                        <div class="flex items-end h-full space-x-2">
                            <div class="flex-1 bg-blue-100 rounded-t flex items-end justify-center">
                                <div class="bg-blue-500 w-full rounded-t" style="height: 40%"></div>
                            </div>
                            <div class="flex-1 bg-blue-100 rounded-t flex items-end justify-center">
                                <div class="bg-blue-500 w-full rounded-t" style="height: 60%"></div>
                            </div>
                            <div class="flex-1 bg-blue-100 rounded-t flex items-end justify-center">
                                <div class="bg-blue-500 w-full rounded-t" style="height: 75%"></div>
                            </div>
                            <div class="flex-1 bg-blue-100 rounded-t flex items-end justify-center">
                                <div class="bg-blue-500 w-full rounded-t" style="height: 90%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between mt-2 text-xs text-gray-500">
                            <span>Week 1</span>
                            <span>Week 2</span>
                            <span>Week 3</span>
                            <span>Week 4</span>
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Highest Earning Day</p>
                            <p class="font-medium">Friday</p>
                            <p class="text-sm text-gray-500">GH₵215.50</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Average Daily Earnings</p>
                            <p class="font-medium">GH₵178.20</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Projected Weekly Earnings</p>
                            <p class="font-medium">GH₵1,247.40</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Transaction History</h3>
                    <p class="mt-1 text-sm text-gray-500">Your last 15 transactions</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 3:45 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Delivery</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Order #ORD-7942</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+GH₵24.50</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Completed</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 2:30 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tip</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Order #ORD-7941</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+GH₵10.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Completed</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today, 1:15 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Delivery</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Order #ORD-7940</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+GH₵18.75</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Completed</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yesterday, 6:30 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Bonus</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Peak hours bonus</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+GH₵25.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Completed</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yesterday, 5:45 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Delivery</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Order #ORD-7938</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+GH₵20.50</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Completed</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yesterday, 4:20 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tip</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Order #ORD-7937</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+GH₵15.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Completed</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2 days ago, 3:10 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cashout</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">MTN Mobile Money</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">-GH₵1,000.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-4 sm:px-6 border-t border-gray-200">
                    <button class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        View All Transactions
                    </button>
                </div>
            </div>
        </div>

        <!-- Cashout Options -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Cashout Options</h3>
                    <p class="mt-1 text-sm text-gray-500">Withdraw your earnings instantly</p>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Mobile Money -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 transition cursor-pointer">
                            <div class="flex items-center">
                                <div class="p-2 rounded-lg bg-yellow-100 text-yellow-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900">Mobile Money</h4>
                                    <p class="text-sm text-gray-500">Instant transfer to your mobile wallet</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="mobile-number" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                                <input type="text" id="mobile-number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="0244 123 456">
                            </div>
                            <div class="mt-4">
                                <label for="amount" class="block text-sm font-medium text-gray-700">Amount (GH₵)</label>
                                <input type="text" id="amount" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Enter amount">
                            </div>
                            <button class="mt-4 w-full bg-blue-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cashout via Mobile Money
                            </button>
                        </div>
                        
                        <!-- Bank Transfer -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 transition cursor-pointer">
                            <div class="flex items-center">
                                <div class="p-2 rounded-lg bg-green-100 text-green-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900">Bank Transfer</h4>
                                    <p class="text-sm text-gray-500">1-2 business days processing</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="bank" class="block text-sm font-medium text-gray-700">Bank</label>
                                <select id="bank" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option>Ghana Commercial Bank</option>
                                    <option>Ecobank Ghana</option>
                                    <option>Standard Chartered</option>
                                    <option>Absa Bank Ghana</option>
                                    <option>Fidelity Bank Ghana</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <label for="account-number" class="block text-sm font-medium text-gray-700">Account Number</label>
                                <input type="text" id="account-number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Enter account number">
                            </div>
                            <button class="mt-4 w-full bg-blue-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cashout via Bank Transfer
                            </button>
                        </div>
                        
                        <!-- Cash Pickup -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 transition cursor-pointer">
                            <div class="flex items-center">
                                <div class="p-2 rounded-lg bg-purple-100 text-purple-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900">Cash Pickup</h4>
                                    <p class="text-sm text-gray-500">Collect cash at our partner locations</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="pickup-location" class="block text-sm font-medium text-gray-700">Pickup Location</label>
                                <select id="pickup-location" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option>Accra Main Office</option>
                                    <option>Kumasi Service Center</option>
                                    <option>Tema Branch</option>
                                    <option>Takoradi Collection Point</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <label for="cash-amount" class="block text-sm font-medium text-gray-700">Amount (GH₵)</label>
                                <input type="text" id="cash-amount" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Enter amount">
                            </div>
                            <button class="mt-4 w-full bg-blue-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Schedule Cash Pickup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-rider-nav>