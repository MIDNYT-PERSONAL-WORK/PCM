<x-rider-nav>
    <div class="min-h-screen bg-gray-50">
        <!-- Filters and Actions -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-4 sm:px-6">
                    <form method="GET" action="{{ route('rider.delivery') }}">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                            <div class="flex-1">
                                <div class="flex space-x-4">
                                    <div class="flex-1 max-w-xs">
                                        <label for="search" class="sr-only">Search</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Search orders" type="search" value="{{ request('search') }}">
                                        </div>
                                    </div>
                                    <div>
                                        <select id="status" name="status" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                            <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All Statuses</option>
                                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="in-progress" {{ request('status') === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <select id="sort" name="sort" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                    <option value="amount-high" {{ request('sort') === 'amount-high' ? 'selected' : '' }}>Amount (High to Low)</option>
                                    <option value="amount-low" {{ request('sort') === 'amount-low' ? 'selected' : '' }}>Amount (Low to High)</option>
                                </select>
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delivery List -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pickup</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delivery</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($deliveries as $delivery)
                                <tr class="{{ in_array($delivery['status'], ['In Progress', 'Completed']) ? 'bg-' . ($delivery['status'] === 'Completed' ? 'gray-50' : 'blue-50') : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-{{ $delivery['status'] === 'Completed' ? 'green-100' : ($delivery['status'] === 'In Progress' ? 'blue-100' : 'gray-100') }} rounded-full flex items-center justify-center text-{{ $delivery['status'] === 'Completed' ? 'green-600' : ($delivery['status'] === 'In Progress' ? 'blue-600' : 'gray-600') }}">
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $delivery['status'] === 'Completed' ? 'M5 13l4 4L19 7' : ($delivery['status'] === 'In Progress' ? 'M13 10V3L4 14h7v7l9-11h-7z' : 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z') }}" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-{{ $delivery['status'] === 'In Progress' ? 'blue-600' : 'gray-900' }}">{{ $delivery['order_number'] }}</div>
                                                <div class="text-sm text-gray-500">{{ $delivery['created_at'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $delivery['customer_name'] }}</div>
                                        <div class="text-sm text-gray-500">{{ $delivery['phone'] }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ explode(', ', $delivery['pickup'])[0] }}</div>
                                        <div class="text-sm text-gray-500">{{ explode(', ', $delivery['pickup'])[1] ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ explode(', ', $delivery['delivery'])[0] }}</div>
                                        <div class="text-sm text-gray-500">{{ explode(', ', $delivery['delivery'])[1] ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $delivery['status'] === 'Completed' ? 'green-100 text-green-800' : ($delivery['status'] === 'In Progress' ? 'blue-100 text-blue-800' : 'yellow-100 text-yellow-800') }}">
                                            {{ $delivery['status'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $delivery['amount'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if ($delivery['navigate'])
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Navigate</a>
                                        @endif
                                        <a href="#" class="text-{{ $delivery['action'] === 'Complete' ? 'green-600 hover:text-green-900' : 'blue-600 hover:text-blue-900' }}">{{ $delivery['action'] }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No deliveries found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-4 sm:px-6 border-t border-gray-200">
                    <div class="flex-1 flex justify-between sm:hidden">
                        {{ $deliveries->links('pagination::simple-tailwind') }}
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">{{ $deliveries->firstItem() }}</span>
                                to
                                <span class="font-medium">{{ $deliveries->lastItem() }}</span>
                                of
                                <span class="font-medium">{{ $deliveries->total() }}</span>
                                results
                            </p>
                        </div>
                        <div>
                            {{ $deliveries->appends(request()->query())->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-rider-nav>