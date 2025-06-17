<x-admin-nav>
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-pam-blue">Customers</h2>
            <p class="text-pam-gray">Manage all customer accounts and information</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button class="bg-pam-blue hover:bg-pam-blue-light text-white px-4 py-2 rounded-lg flex items-center transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add New Customer
            </button>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
        <div class="relative flex-grow max-w-md">
            <input type="text" placeholder="Search customers..." class="w-full pl-10 pr-4 py-2 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
            <div class="absolute left-3 top-2.5 text-pam-gray">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <select class="border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                <option>All Status</option>
                <option>Active</option>
                <option>Inactive</option>
                <option>Pending</option>
            </select>
            <select class="border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                <option>Sort by: Newest</option>
                <option>Sort by: Oldest</option>
                <option>Sort by: Name</option>
            </select>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-pam-gray-light">
            <thead class="bg-pam-gray-light">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Customer</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Phone</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Orders</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-pam-gray uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pam-gray-light">
                <!-- Customer 1 -->
                <tr class="hover:bg-pam-gray-light/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/42.jpg" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-pam-blue">Sarah Johnson</div>
                                <div class="text-sm text-pam-gray">Customer ID: CUS-001</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">sarah.johnson@example.com</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">(555) 123-4567</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">24</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">View</button>
                        <button class="text-pam-green hover:text-green-700">Edit</button>
                    </td>
                </tr>

                <!-- Customer 2 -->
                <tr class="hover:bg-pam-gray-light/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-pam-blue">Michael Chen</div>
                                <div class="text-sm text-pam-gray">Customer ID: CUS-002</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">michael.chen@example.com</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">(555) 987-6543</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">15</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">View</button>
                        <button class="text-pam-green hover:text-green-700">Edit</button>
                    </td>
                </tr>

                <!-- Customer 3 -->
                <tr class="hover:bg-pam-gray-light/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/63.jpg" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-pam-blue">Emma Rodriguez</div>
                                <div class="text-sm text-pam-gray">Customer ID: CUS-003</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">emma.rodriguez@example.com</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">(555) 456-7890</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">8</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">View</button>
                        <button class="text-pam-green hover:text-green-700">Edit</button>
                    </td>
                </tr>

                <!-- Customer 4 -->
                <tr class="hover:bg-pam-gray-light/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/75.jpg" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-pam-blue">David Wilson</div>
                                <div class="text-sm text-pam-gray">Customer ID: CUS-004</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">david.wilson@example.com</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">(555) 789-0123</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">32</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">View</button>
                        <button class="text-pam-green hover:text-green-700">Edit</button>
                    </td>
                </tr>

                <!-- Customer 5 -->
                <tr class="hover:bg-pam-gray-light/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/28.jpg" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-pam-blue">Jessica Lee</div>
                                <div class="text-sm text-pam-gray">Customer ID: CUS-005</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">jessica.lee@example.com</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">(555) 234-5678</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">5</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">View</button>
                        <button class="text-pam-green hover:text-green-700">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-pam-gray">
            Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">24</span> customers
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



</x-admin-nav>