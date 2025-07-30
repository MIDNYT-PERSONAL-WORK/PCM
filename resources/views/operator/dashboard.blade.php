<x-operator-nav>
        
        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
   
            

            
            <!-- Main content area -->
            <div class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Pending Dispatch</p>
                                <p class="text-2xl font-semibold text-pam-blue">24</p>
                                <p class="text-xs text-pam-gray">Ready for assignment</p>
                            </div>
                            <div class="p-3 rounded-lg bg-yellow-100/10 text-yellow-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">In Transit</p>
                                <p class="text-2xl font-semibold text-pam-blue">48</p>
                                <p class="text-xs text-pam-gray">Active deliveries</p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-blue-light/10 text-pam-blue-light">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Active Riders</p>
                                <p class="text-2xl font-semibold text-pam-blue">36</p>
                                <p class="text-xs text-pam-green flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    5 more than yesterday
                                </p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-green/10 text-pam-green">
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
                                <p class="text-sm font-medium text-pam-gray">Avg. Delivery Time</p>
                                <p class="text-2xl font-semibold text-pam-blue">42m</p>
                                <p class="text-xs text-pam-gray">From pickup to delivery</p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-blue/10 text-pam-blue">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Map and Orders -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Map -->
                    <div class="lg:col-span-2 bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-pam-gray">Delivery Network</h2>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 text-sm border border-pam-gray-light rounded-lg bg-white hover:bg-pam-gray-light">Riders</button>
                                <button class="px-3 py-1 text-sm border border-pam-gray-light rounded-lg bg-white hover:bg-pam-gray-light">Deliveries</button>
                                <button class="px-3 py-1 text-sm border border-pam-gray-light rounded-lg bg-pam-blue-light text-white">Both</button>
                            </div>
                        </div>
                        <div class="map-container rounded-lg">
                            <!-- These would be dynamically positioned in a real app -->
                            <div class="rider-marker" style="top: 30%; left: 25%;"></div>
                            <div class="rider-marker" style="top: 45%; left: 60%;"></div>
                            <div class="rider-marker" style="top: 65%; left: 40%;"></div>
                            <div class="delivery-marker" style="top: 35%; left: 30%;"></div>
                            <div class="delivery-marker" style="top: 50%; left: 55%;"></div>
                            <div class="delivery-marker" style="top: 70%; left: 35%;"></div>
                            <div class="delivery-marker" style="top: 25%; left: 50%;"></div>
                        </div>
                    </div>
                    
                    <!-- Pending Dispatch -->
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-pam-gray">Pending Dispatch</h2>
                            <a href="#" class="text-sm font-medium text-pam-blue-light hover:text-pam-blue">View All</a>
                        </div>
                        <div class="space-y-4">
                            <div class="p-3 border border-pam-gray-light rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-pam-blue">#ORD-7842</p>
                                        <p class="text-xs text-pam-gray">Fresh Groceries</p>
                                    </div>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Ready</span>
                                </div>
                                <div class="mt-2 flex justify-between items-center">
                                    <div>
                                        <p class="text-xs text-pam-gray">Delivery to:</p>
                                        <p class="text-sm text-pam-gray">123 Main St, Apt 4B</p>
                                    </div>
                                    <button class="px-2 py-1 text-xs bg-pam-blue-light text-white rounded hover:bg-pam-blue">Assign</button>
                                </div>
                            </div>
                            <div class="p-3 border border-pam-gray-light rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-pam-blue">#ORD-7841</p>
                                        <p class="text-xs text-pam-gray">ElectroHub</p>
                                    </div>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Ready</span>
                                </div>
                                <div class="mt-2 flex justify-between items-center">
                                    <div>
                                        <p class="text-xs text-pam-gray">Delivery to:</p>
                                        <p class="text-sm text-pam-gray">456 Oak Ave</p>
                                    </div>
                                    <button class="px-2 py-1 text-xs bg-pam-blue-light text-white rounded hover:bg-pam-blue">Assign</button>
                                </div>
                            </div>
                            <div class="p-3 border border-pam-gray-light rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-pam-blue">#ORD-7840</p>
                                        <p class="text-xs text-pam-gray">Fashion Boutique</p>
                                    </div>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Ready</span>
                                </div>
                                <div class="mt-2 flex justify-between items-center">
                                    <div>
                                        <p class="text-xs text-pam-gray">Delivery to:</p>
                                        <p class="text-sm text-pam-gray">789 Pine Blvd</p>
                                    </div>
                                    <button class="px-2 py-1 text-xs bg-pam-blue-light text-white rounded hover:bg-pam-blue">Assign</button>
                                </div>
                            </div>
                            <div class="p-3 border border-pam-gray-light rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-pam-blue">#ORD-7839</p>
                                        <p class="text-xs text-pam-gray">Book Haven</p>
                                    </div>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Ready</span>
                                </div>
                                <div class="mt-2 flex justify-between items-center">
                                    <div>
                                        <p class="text-xs text-pam-gray">Delivery to:</p>
                                        <p class="text-sm text-pam-gray">321 Elm St</p>
                                    </div>
                                    <button class="px-2 py-1 text-xs bg-pam-blue-light text-white rounded hover:bg-pam-blue">Assign</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-pam-gray">Recent Activity</h2>
                        <a href="#" class="text-sm font-medium text-pam-blue-light hover:text-pam-blue">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-8 w-8 rounded-full bg-pam-green/10 text-pam-green flex items-center justify-center">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-pam-gray">
                                    <span class="font-medium text-pam-blue">Order #ORD-7838</span> delivered by <span class="font-medium">Rider #45</span>
                                </p>
                                <p class="text-xs text-pam-gray">2 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-8 w-8 rounded-full bg-pam-blue-light/10 text-pam-blue-light flex items-center justify-center">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-pam-gray">
                                    <span class="font-medium text-pam-blue">Order #ORD-7837</span> picked up by <span class="font-medium">Rider #32</span>
                                </p>
                                <p class="text-xs text-pam-gray">15 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-8 w-8 rounded-full bg-pam-blue/10 text-pam-blue flex items-center justify-center">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-pam-gray">
                                    <span class="font-medium text-pam-blue">New order</span> received from <span class="font-medium">ElectroHub</span>
                                </p>
                                <p class="text-xs text-pam-gray">25 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-8 w-8 rounded-full bg-pam-green/10 text-pam-green flex items-center justify-center">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-pam-gray">
                                    <span class="font-medium text-pam-blue">Order #ORD-7836</span> delivered by <span class="font-medium">Rider #28</span>
                                </p>
                                <p class="text-xs text-pam-gray">42 minutes ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-operator-nav>