<x-rider-nav>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-600">Performance Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Notifications</span>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                    </div>
                    <div class="flex items-center">
                        <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <span class="ml-2 text-sm font-medium text-gray-700">John Rider</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Performance Overview -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Performance Overview</h3>
                    <p class="mt-1 text-sm text-gray-500">Your delivery performance metrics for this month</p>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Total Deliveries -->
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total Deliveries</p>
                                    <p class="text-2xl font-semibold text-gray-900">142</p>
                                    <p class="text-xs text-blue-600 mt-1">+12% from last month</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- On-Time Rate -->
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">On-Time Rate</p>
                                    <p class="text-2xl font-semibold text-gray-900">94%</p>
                                    <p class="text-xs text-green-600 mt-1">+3% from last month</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Avg. Rating -->
                        <div class="bg-yellow-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Avg. Rating</p>
                                    <div class="flex items-center">
                                        <p class="text-2xl font-semibold text-gray-900">4.8</p>
                                        <div class="flex ml-2">
                                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-xs text-yellow-600 mt-1">From 124 ratings</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Total Earnings -->
                        <div class="bg-purple-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total Earnings</p>
                                    <p class="text-2xl font-semibold text-gray-900">GH₵2,845</p>
                                    <p class="text-xs text-purple-600 mt-1">+15% from last month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Charts -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Weekly Deliveries Chart -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Weekly Deliveries</h3>
                        <p class="mt-1 text-sm text-gray-500">Your delivery volume over the past 4 weeks</p>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="h-64">
                            <!-- Chart placeholder - would be replaced with actual chart library -->
                            <div class="flex items-end h-full space-x-2">
                                <div class="flex-1 bg-blue-100 rounded-t flex items-end justify-center">
                                    <div class="bg-blue-500 w-full rounded-t" style="height: 30%"></div>
                                </div>
                                <div class="flex-1 bg-blue-100 rounded-t flex items-end justify-center">
                                    <div class="bg-blue-500 w-full rounded-t" style="height: 45%"></div>
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
                                <div class="flex-1 bg-blue-100 rounded-t flex items-end justify-center">
                                    <div class="bg-blue-500 w-full rounded-t" style="height: 65%"></div>
                                </div>
                                <div class="flex-1 bg-blue-100 rounded-t flex items-end justify-center">
                                    <div class="bg-blue-500 w-full rounded-t" style="height: 50%"></div>
                                </div>
                            </div>
                            <div class="flex justify-between mt-2 text-xs text-gray-500">
                                <span>Week 1</span>
                                <span>Week 2</span>
                                <span>Week 3</span>
                                <span>Week 4</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Delivery Time Distribution -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Delivery Time Distribution</h3>
                        <p class="mt-1 text-sm text-gray-500">How your delivery times compare to targets</p>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="h-64">
                            <!-- Chart placeholder - would be replaced with actual chart library -->
                            <div class="flex items-end h-full space-x-4">
                                <div class="flex-1">
                                    <div class="text-center text-xs text-gray-500 mb-1">Early</div>
                                    <div class="bg-green-100 rounded-t h-full flex items-end justify-center">
                                        <div class="bg-green-500 w-full rounded-t" style="height: 25%"></div>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="text-center text-xs text-gray-500 mb-1">On Time</div>
                                    <div class="bg-blue-100 rounded-t h-full flex items-end justify-center">
                                        <div class="bg-blue-500 w-full rounded-t" style="height: 65%"></div>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="text-center text-xs text-gray-500 mb-1">Late</div>
                                    <div class="bg-red-100 rounded-t h-full flex items-end justify-center">
                                        <div class="bg-red-500 w-full rounded-t" style="height: 10%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Details -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Detailed Performance Metrics</h3>
                    <p class="mt-1 text-sm text-gray-500">Your complete performance breakdown</p>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Rating Breakdown -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Rating Breakdown</h4>
                            <div class="space-y-3">
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-500">5 Stars</span>
                                        <span class="font-medium">84%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 84%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-500">4 Stars</span>
                                        <span class="font-medium">12%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 12%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-500">3 Stars</span>
                                        <span class="font-medium">3%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-yellow-300 h-2 rounded-full" style="width: 3%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-500">2 Stars</span>
                                        <span class="font-medium">1%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-yellow-200 h-2 rounded-full" style="width: 1%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-500">1 Star</span>
                                        <span class="font-medium">0%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-yellow-100 h-2 rounded-full" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Earnings Breakdown -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Earnings Breakdown</h4>
                            <div class="space-y-3">
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-500">Base Pay</span>
                                        <span class="font-medium">GH₵1,920</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: 67%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-500">Tips</span>
                                        <span class="font-medium">GH₵625</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: 22%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-500">Bonuses</span>
                                        <span class="font-medium">GH₵300</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-purple-500 h-2 rounded-full" style="width: 11%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-900">Total Earnings</span>
                                    <span class="text-sm font-medium text-gray-900">GH₵2,845</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Peak Performance -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Peak Performance Times</h4>
                            <div class="grid grid-cols-3 gap-2 text-xs text-center">
                                <div class="bg-gray-100 p-2 rounded">8-10 AM<br><span class="font-medium">12%</span></div>
                                <div class="bg-blue-100 p-2 rounded">10-12 PM<br><span class="font-medium">18%</span></div>
                                <div class="bg-gray-100 p-2 rounded">12-2 PM<br><span class="font-medium">15%</span></div>
                                <div class="bg-blue-100 p-2 rounded">2-4 PM<br><span class="font-medium">22%</span></div>
                                <div class="bg-blue-500 text-white p-2 rounded">4-6 PM<br><span class="font-medium">28%</span></div>
                                <div class="bg-gray-100 p-2 rounded">6-8 PM<br><span class="font-medium">5%</span></div>
                            </div>
                            <div class="mt-4 text-sm text-gray-500">
                                <p>Your best performing time slot is <span class="font-medium text-gray-900">4-6 PM</span> with the highest on-time delivery rate (98%).</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-rider-nav>