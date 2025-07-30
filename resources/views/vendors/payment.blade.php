<x-vendor-nav>
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-pam-blue">Payments & Payouts</h2>
            <p class="text-pam-gray">Manage your earnings and payment methods</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button onclick="openRequestPayoutModal()" class="bg-pam-blue hover:bg-pam-blue-light text-white px-4 py-2 rounded-lg flex items-center transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Request Payout
            </button>
        </div>
    </div>

    <!-- Payment Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Available Balance</div>
            <div class="text-2xl font-bold text-pam-blue">$4,287.50</div>
            <div class="text-xs text-pam-gray">Amount ready for payout</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Pending Balance</div>
            <div class="text-2xl font-bold text-pam-blue">$1,245.30</div>
            <div class="text-xs text-pam-gray">Processing or in transit</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Last Payout</div>
            <div class="text-2xl font-bold text-pam-blue">$3,500.00</div>
            <div class="text-xs text-pam-green flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                Completed on May 15, 2023
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="border-b border-pam-gray-light mb-6">
        <nav class="-mb-px flex space-x-8">
            <button id="transactionsTab" class="border-b-2 border-pam-blue text-pam-blue whitespace-nowrap py-4 px-1 font-medium text-sm">
                Transactions
            </button>
            <button id="payoutMethodsTab" class="border-b-2 border-transparent text-pam-gray hover:text-pam-blue hover:border-pam-gray-light whitespace-nowrap py-4 px-1 font-medium text-sm">
                Payout Methods
            </button>
            <button id="payoutHistoryTab" class="border-b-2 border-transparent text-pam-gray hover:text-pam-blue hover:border-pam-gray-light whitespace-nowrap py-4 px-1 font-medium text-sm">
                Payout History
            </button>
        </nav>
    </div>

    <!-- Transactions Tab Content -->
    <div id="transactionsContent" class="tab-content">
        <!-- Filter and Search Bar -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <div class="flex items-center overflow-x-auto space-x-2">
                <button class="px-3 py-1 bg-pam-blue text-white rounded-lg text-sm">All</button>
                <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Sales</button>
                <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Refunds</button>
                <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Fees</button>
            </div>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <input type="text" placeholder="Search transactions..." class="w-full pl-10 pr-4 py-2 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
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

        <!-- Transactions Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-pam-gray-light">
                <thead class="bg-pam-gray-light">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Order ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Customer</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Type</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-pam-gray uppercase tracking-wider">Amount</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-pam-gray-light">
                    <!-- Transaction 1 -->
                    <tr class="hover:bg-pam-gray-light/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">May 18, 2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-pam-blue">#ORD-7842</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Alex Johnson</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Sale</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="text-sm font-medium text-pam-green">+$129.99</div>
                        </td>
                    </tr>

                    <!-- Transaction 2 -->
                    <tr class="hover:bg-pam-gray-light/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">May 17, 2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-pam-blue">#ORD-7831</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Sarah Williams</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Sale</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="text-sm font-medium text-pam-green">+$87.50</div>
                        </td>
                    </tr>

                    <!-- Transaction 3 -->
                    <tr class="hover:bg-pam-gray-light/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">May 16, 2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-pam-blue">#ORD-7825</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Michael Brown</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Refund</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Processed</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="text-sm font-medium text-red-500">-$45.00</div>
                        </td>
                    </tr>

                    <!-- Transaction 4 -->
                    <tr class="hover:bg-pam-gray-light/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">May 15, 2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-pam-blue">#FEE-0531</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Service Fee</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Fee</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Completed</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="text-sm font-medium text-red-500">-$12.99</div>
                        </td>
                    </tr>

                    <!-- Transaction 5 -->
                    <tr class="hover:bg-pam-gray-light/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">May 14, 2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-pam-blue">#ORD-7812</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Emily Davis</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Sale</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="text-sm font-medium text-pam-green">+$65.99</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6">
            <div class="text-sm text-pam-gray">
                Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">24</span> transactions
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

    <!-- Payout Methods Tab Content -->
    <div id="payoutMethodsContent" class="tab-content hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Current Payout Method -->
            <div class="bg-pam-gray-light rounded-lg p-6">
                <h3 class="text-lg font-medium text-pam-blue mb-4">Current Payout Method</h3>
                
                <div class="border border-pam-gray-light rounded-lg p-4 bg-white">
                    <div class="flex items-center mb-3">
                        <div class="bg-pam-blue rounded-full p-2 mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-pam-blue">Bank Transfer</h4>
                            <p class="text-sm text-pam-gray">Primary payout method</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-pam-gray">Bank Name:</span>
                            <span class="font-medium">Chase Bank</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-pam-gray">Account Name:</span>
                            <span class="font-medium">John Smith</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-pam-gray">Account Number:</span>
                            <span class="font-medium">•••• •••• 5678</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-pam-gray">Routing Number:</span>
                            <span class="font-medium">•••••••890</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-pam-gray-light flex space-x-3">
                        <button onclick="openEditPayoutMethodModal()" class="text-pam-blue-light hover:text-pam-blue text-sm font-medium">Edit</button>
                        <button class="text-red-500 hover:text-red-700 text-sm font-medium">Remove</button>
                    </div>
                </div>
            </div>
            
            <!-- Add New Payout Method -->
            <div class="bg-pam-gray-light rounded-lg p-6">
                <h3 class="text-lg font-medium text-pam-blue mb-4">Add Payout Method</h3>
                
                <div class="space-y-4">
                    <div>
                        <button onclick="openAddPayoutMethodModal('bank')" class="w-full border border-pam-gray-light rounded-lg p-4 bg-white hover:bg-pam-gray-light/50 transition flex items-center">
                            <div class="bg-pam-blue rounded-full p-2 mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <h4 class="font-medium text-pam-blue">Bank Transfer</h4>
                                <p class="text-sm text-pam-gray">Direct deposit to your bank account</p>
                            </div>
                        </button>
                    </div>
                    
                    <div>
                        <button onclick="openAddPayoutMethodModal('paypal')" class="w-full border border-pam-gray-light rounded-lg p-4 bg-white hover:bg-pam-gray-light/50 transition flex items-center">
                            <div class="bg-blue-500 rounded-full p-2 mr-3">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.067 8.478c.492.88.556 2.014.3 3.327-.74 3.806-3.276 5.12-6.514 5.12h-.5a.805.805 0 0 0-.794.68l-.04.22-.63 3.993-.032.17a.804.804 0 0 1-.794.679H7.72a.483.483 0 0 1-.477-.558L7.418 21h1.518l.95-6.02h1.385c4.678 0 7.75-2.203 8.796-6.502zm-2.96-5.09c.762.868.983 1.81.752 3.285-.019.123-.04.24-.062.36-.735 3.773-3.089 5.446-6.956 5.446H8.957c-.63 0-1.174.414-1.354 1.002l-.014-.002-.93 5.894H3.121a.051.051 0 0 1-.05-.06l2.598-16.51A.95.95 0 0 1 6.607 2h5.976c2.183 0 3.716.469 4.523 1.388z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <h4 class="font-medium text-pam-blue">PayPal</h4>
                                <p class="text-sm text-pam-gray">Transfer to your PayPal account</p>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payout History Tab Content -->
    <div id="payoutHistoryContent" class="tab-content hidden">
        <!-- Filter Bar -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <div class="flex items-center space-x-2">
                <div class="relative">
                    <select class="appearance-none bg-white border border-pam-gray-light rounded-lg px-4 py-2 pr-8 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        <option>Last 30 Days</option>
                        <option>Last 90 Days</option>
                        <option>This Year</option>
                        <option>Last Year</option>
                        <option>All Time</option>
                    </select>
                    <div class="absolute right-3 top-2.5 text-pam-gray">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <input type="text" placeholder="Search payouts..." class="w-full pl-10 pr-4 py-2 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    <div class="absolute left-3 top-2.5 text-pam-gray">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payouts Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-pam-gray-light">
                <thead class="bg-pam-gray-light">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Payout ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Method</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-pam-gray uppercase tracking-wider">Amount</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-pam-gray-light">
                    <!-- Payout 1 -->
                    <tr class="hover:bg-pam-gray-light/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">May 15, 2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-pam-blue">#PY-2023-0515</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Bank Transfer</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="text-sm font-medium text-pam-blue">$3,500.00</div>
                        </td>
                    </tr>

                    <!-- Payout 2 -->
                    <tr class="hover:bg-pam-gray-light/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">April 30, 2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-pam-blue">#PY-2023-0430</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Bank Transfer</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="text-sm font-medium text-pam-blue">$2,870.25</div>
                        </td>
                    </tr>

                    <!-- Payout 3 -->
                    <tr class="hover:bg-pam-gray-light/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">April 15, 2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-pam-blue">#PY-2023-0415</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">Bank Transfer</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="text-sm font-medium text-pam-blue">$3,120.50</div>
                        </td>
                    </tr>

                    <!-- Payout 4 -->
                    <tr class="hover:bg-pam-gray-light/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">March 31, 2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-pam-blue">#PY-2023-0331</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-pam-gray">PayPal</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="text-sm font-medium text-pam-blue">$2,950.75</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6">
            <div class="text-sm text-pam-gray">
                Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">12</span> payouts
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
</div>

<!-- Request Payout Modal -->
<div id="requestPayoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-pam-blue">Request Payout</h3>
                <button onclick="closeRequestPayoutModal()" class="text-pam-gray hover:text-pam-blue">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-pam-gray mb-1">Available Balance</label>
                <div class="text-2xl font-bold text-pam-blue">$4,287.50</div>
            </div>
            
            <div class="mb-4">
                <label for="payoutAmount" class="block text-sm font-medium text-pam-gray mb-1">Payout Amount ($)</label>
                <input type="number" id="payoutAmount" step="0.01" min="10" max="4287.50" value="4287.50" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                <p class="mt-1 text-xs text-pam-gray">Minimum payout amount is $10.00</p>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-pam-gray mb-1">Payout Method</label>
                <div class="border border-pam-gray-light rounded-lg p-3 bg-white">
                    <div class="flex items-center">
                        <div class="bg-pam-blue rounded-full p-2 mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-pam-blue">Chase Bank ••••5678</h4>
                            <p class="text-xs text-pam-gray">Standard transfer (3-5 business days)</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="pt-4 border-t border-pam-gray-light flex justify-end space-x-3">
                <button onclick="closeRequestPayoutModal()" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition">Cancel</button>
                <button onclick="confirmPayoutRequest()" class="px-4 py-2 bg-pam-green text-white rounded-lg hover:bg-green-600 transition">Request Payout</button>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Payout Method Modal -->
<div id="payoutMethodModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-pam-blue" id="payoutMethodModalTitle">Add Bank Account</h3>
                <button onclick="closePayoutMethodModal()" class="text-pam-gray hover:text-pam-blue">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="payoutMethodForm">
                <input type="hidden" id="payoutMethodType">
                
                <!-- Bank Account Fields -->
                <div id="bankAccountFields">
                    <div class="mb-4">
                        <label for="accountHolderName" class="block text-sm font-medium text-pam-gray mb-1">Account Holder Name</label>
                        <input type="text" id="accountHolderName" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    </div>
                    
                    <div class="mb-4">
                        <label for="bankName" class="block text-sm font-medium text-pam-gray mb-1">Bank Name</label>
                        <input type="text" id="bankName" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    </div>
                    
                    <div class="mb-4">
                        <label for="accountNumber" class="block text-sm font-medium text-pam-gray mb-1">Account Number</label>
                        <input type="text" id="accountNumber" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    </div>
                    
                    <div class="mb-4">
                        <label for="routingNumber" class="block text-sm font-medium text-pam-gray mb-1">Routing Number</label>
                        <input type="text" id="routingNumber" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    </div>
                </div>
                
                <!-- PayPal Fields -->
                <div id="paypalFields" class="hidden">
                    <div class="mb-4">
                        <label for="paypalEmail" class="block text-sm font-medium text-pam-gray mb-1">PayPal Email</label>
                        <input type="email" id="paypalEmail" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    </div>
                    
                    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-4">
                        <div class="flex items-start">
                            <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm text-blue-700">You'll need to confirm your PayPal account before receiving payouts.</p>
                        </div>
                    </div>
                </div>
                
                <div class="pt-4 border-t border-pam-gray-light flex justify-end space-x-3">
                    <button type="button" onclick="closePayoutMethodModal()" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-pam-green text-white rounded-lg hover:bg-green-600 transition">Save Method</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Tab switching functionality
    document.getElementById('transactionsTab').addEventListener('click', function() {
        switchTab('transactions');
    });
    
    document.getElementById('payoutMethodsTab').addEventListener('click', function() {
        switchTab('payoutMethods');
    });
    
    document.getElementById('payoutHistoryTab').addEventListener('click', function() {
        switchTab('payoutHistory');
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
    
    // Payout Request Modal
    function openRequestPayoutModal() {
        document.getElementById('requestPayoutModal').classList.remove('hidden');
    }
    
    function closeRequestPayoutModal() {
        document.getElementById('requestPayoutModal').classList.add('hidden');
    }
    
    function confirmPayoutRequest() {
        const amount = document.getElementById('payoutAmount').value;
        alert(`Payout request for $${amount} submitted successfully!`);
        closeRequestPayoutModal();
    }
    
    // Payout Method Modal
    function openAddPayoutMethodModal(type) {
        document.getElementById('payoutMethodType').value = type;
        
        if (type === 'bank') {
            document.getElementById('payoutMethodModalTitle').textContent = 'Add Bank Account';
            document.getElementById('bankAccountFields').classList.remove('hidden');
            document.getElementById('paypalFields').classList.add('hidden');
        } else if (type === 'paypal') {
            document.getElementById('payoutMethodModalTitle').textContent = 'Add PayPal Account';
            document.getElementById('bankAccountFields').classList.add('hidden');
            document.getElementById('paypalFields').classList.remove('hidden');
        }
        
        document.getElementById('payoutMethodModal').classList.remove('hidden');
    }
    
    function openEditPayoutMethodModal() {
        document.getElementById('payoutMethodModalTitle').textContent = 'Edit Bank Account';
        document.getElementById('bankAccountFields').classList.remove('hidden');
        document.getElementById('paypalFields').classList.add('hidden');
        document.getElementById('payoutMethodModal').classList.remove('hidden');
        
        // In a real app, you would populate the form with existing data
        document.getElementById('accountHolderName').value = 'John Smith';
        document.getElementById('bankName').value = 'Chase Bank';
        document.getElementById('accountNumber').value = '98765432';
        document.getElementById('routingNumber').value = '021000021';
    }
    
    function closePayoutMethodModal() {
        document.getElementById('payoutMethodModal').classList.add('hidden');
        document.getElementById('payoutMethodForm').reset();
    }
    
    // Form submission
    document.getElementById('payoutMethodForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const type = document.getElementById('payoutMethodType').value;
        alert(`${type === 'bank' ? 'Bank account' : 'PayPal account'} added successfully!`);
        closePayoutMethodModal();
        
        // In a real app, you would refresh the payout methods list
    });
    
    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target === document.getElementById('requestPayoutModal')) {
            closeRequestPayoutModal();
        }
        
        if (event.target === document.getElementById('payoutMethodModal')) {
            closePayoutMethodModal();
        }
    });
</script>
</x-vendor-nav>