<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        :root {
            --pam-blue: #2563eb;
            --pam-blue-light: #3b82f6;
            --pam-green: #10b981;
            --pam-gray: #6b7280;
            --pam-gray-light: #e5e7eb;
        }
        body {
            font-family: 'Nunito', sans-serif;
        }
        #delivery-map {
            height: 100%;
            width: 100%;
            z-index: 1;
        }
        .leaflet-routing-container {
            display: none;
        }
        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            background: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            border-radius: 0.5rem;
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-100">
    <x-rider-nav>
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Main content area -->
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
            
            <div class="flex-1 overflow-y-auto p-4 md:p-6 space-y-6">
                <!-- Status Bar -->
                <div class="flex flex-col md:flex-row gap-4 justify-between items-start md:items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-pam-blue">Delivery Dashboard</h1>
                        <p class="text-pam-gray">Welcome back, {{ auth()->user()->name ?? 'Rider' }}</p>
                    </div>
                </div>
                
                <!-- Status Toggle -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 mt-4">
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Delivery Status</h3>
                                <p class="mt-1 text-sm text-gray-500" id="status-text">You're currently offline</p>
                            </div>
                            <button type="button" id="toggle-switch" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-gray-200">
                                <span class="sr-only">Toggle online status</span>
                                <span id="toggle-circle" aria-hidden="true" class="translate-x-0 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Today's Deliveries -->
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-pam-gray-light hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Today's Deliveries</p>
                                <p class="text-2xl font-bold text-pam-blue mt-1">{{ $totalTodayDelivery ?? 0 }}</p>
                                <div class="flex items-center mt-2">
                                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                                        @php
                                            $progress = min(($totalTodayDelivery ?? 0) / 8 * 100, 100);
                                        @endphp
                                        <div class="bg-pam-blue h-1.5 rounded-full" style="width: {{ $progress }}%"></div>
                                    </div>
                                    <span class="text-xs text-pam-gray ml-2">{{ $totalTodayDelivery ?? 0 }}/8</span>
                                </div>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-blue-light/10 text-pam-blue-light">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Today's Earnings -->
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-pam-gray-light hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Today's Earnings</p>
                                <p class="text-2xl font-bold text-pam-blue mt-1">GH₵{{ number_format($todayEarnings ?? 0, 2) }}</p>
                                <div class="flex items-center mt-2">
                                    <svg class="w-4 h-4 text-pam-green mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    <span class="text-xs text-pam-green">12% from yesterday</span>
                                </div>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-green/10 text-pam-green">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Avg. Delivery Time -->
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-pam-gray-light hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Avg. Delivery Time</p>
                                <p class="text-2xl font-bold text-pam-blue mt-1">{{ $avgDeliveryTime ?? '38m' }}</p>
                                <div class="flex items-center mt-2">
                                    <svg class="w-4 h-4 text-pam-blue mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    <span class="text-xs text-pam-blue">Faster than 80%</span>
                                </div>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-blue/10 text-pam-blue">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Current Rating -->
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-pam-gray-light hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Your Rating</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex">
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="text-xl font-bold text-pam-blue ml-1">{{ $currentRating ?? '4.8' }}</span>
                                    </div>
                                </div>
                                <p class="text-xs text-pam-gray mt-2">{{ $totalRatings ?? '124' }} ratings this month</p>
                            </div>
                            <div class="p-3 rounded-lg bg-yellow-100/10 text-yellow-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Delivery Section -->
                @if(isset($deliveries) && $deliveries->isNotEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-pam-gray-light overflow-hidden">
                    <div class="p-5 border-b border-pam-gray-light">
                        <h2 class="text-lg font-bold text-pam-blue">Current Delivery</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <!-- Map Section -->
                        <div class="lg:col-span-2 p-5 border-b lg:border-b-0 lg:border-r border-pam-gray-light">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="font-medium text-pam-gray">Order #{{ $deliveries->first()->order_number ?? 'N/A' }}</h3>
                                    <p class="text-sm text-pam-gray">Estimated delivery time: --:--</p>
                                    <p class="text-sm text-pam-gray mt-1">Status: <span class="font-medium">{{ ucfirst($deliveries->first()->status ?? 'pending') }}</span></p>
                                </div>
                                <div class="flex gap-2">
                                    <button class="px-3 py-1 text-sm border border-pam-gray-light rounded-lg bg-white hover:bg-pam-gray-light flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Details
                                    </button>
                                    <button id="navigate-button" class="px-3 py-1 text-sm rounded-lg bg-pam-blue-light text-white flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                        Navigate
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Leaflet Map Container -->
                            <div class="relative rounded-xl h-64 overflow-hidden">
                                <div id="delivery-map"></div>
                                <div id="map-loading" class="loading-spinner">
                                    <svg class="animate-spin h-8 w-8 text-pam-blue mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <p class="mt-2 text-sm text-pam-gray">Loading map...</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Delivery Details -->
                        <div class="p-5">
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="p-2 rounded-lg bg-pam-blue-light/10 text-pam-blue-light">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-pam-gray">Items ({{ $deliveries->first()->OrderItems->count() ?? 0 }})</h3>
                                        <ul class="text-sm text-pam-gray mt-1 space-y-1">
                                            @forelse ($deliveries->first()->OrderItems ?? [] as $item)
                                                <li class="flex items-center">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-pam-gray mr-2"></span>
                                                    {{ $item->product->name ?? 'Unknown Product' }} ({{ $item->quantity ?? 1 }} items)
                                                </li>
                                            @empty
                                                <li class="text-sm text-gray-500">No items found</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="flex items-start gap-3">
                                    <div class="p-2 rounded-lg bg-green-100 text-green-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-600">Pickup Location</h3>
                                        @if($deliveries->first()->OrderItems->isNotEmpty() && $deliveries->first()->OrderItems->first()->product->vendor)
                                            @php
                                                $vendor = $deliveries->first()->OrderItems->first()->product->vendor;
                                            @endphp
                                            <p class="text-sm text-blue-600 mt-1">{{ $vendor->name ?? 'Unknown Vendor' }}</p>
                                            <p class="text-xs text-gray-500">Vendor Contact: {{ $vendor->phone ?? 'N/A' }}</p>
                                            <p class="text-xs text-gray-500">Email: {{ $vendor->email ?? 'N/A' }}</p>
                                        @else
                                            <p class="text-sm text-gray-500 mt-1">Vendor information not available</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex items-start gap-3">
                                    <div class="p-2 rounded-lg bg-pam-blue/10 text-pam-blue">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-pam-gray">Delivery Location</h3>
                                        <p class="text-sm text-pam-blue mt-1">{{ $deliveries->first()->customer_name ?? 'Customer' }}</p>
                                        <p class="text-xs text-pam-gray">{{ $deliveries->first()->city ?? 'City' }}</p>
                                        <p class="text-xs text-pam-gray">{{ $deliveries->first()->location ?? 'Address not specified' }}</p>
                                        <p class="text-xs text-pam-gray mt-1">Contact: {{ $deliveries->first()->phone ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="p-2 rounded-lg bg-pam-blue/10 text-pam-blue">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-pam-gray">Operator</h3>
                                        @if($deliveries->first()->operator)
                                            <p class="text-sm text-pam-blue mt-1">{{ $deliveries->first()->operator->name ?? 'Operator' }}</p>
                                            <p class="text-xs text-pam-gray">{{ $deliveries->first()->operator->email ?? 'N/A' }}</p>
                                            <p class="text-xs text-pam-gray mt-1">Contact: {{ $deliveries->first()->operator->phone ?? 'N/A' }}</p>
                                        @else
                                            <p class="text-sm text-gray-500 mt-1">Operator information not available</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="pt-4 border-t border-pam-gray-light">
                                    <button class="w-full py-3 px-4 rounded-lg shadow-sm text-sm font-medium text-white bg-pam-green hover:bg-pam-green/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-green transition flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Mark as Delivered
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-white rounded-xl shadow-sm border border-pam-gray-light overflow-hidden">
                    <div class="p-5 border-b border-pam-gray-light">
                        <h2 class="text-lg font-bold text-pam-blue">Current Delivery</h2>
                    </div>
                    <div class="p-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No current deliveries</h3>
                        <p class="mt-1 text-sm text-gray-500">You don't have any active deliveries at the moment.</p>
                    </div>
                </div>
                @endif

                <!-- Next Deliveries -->
                <div class="bg-white rounded-xl shadow-sm border border-pam-gray-light overflow-hidden">
                    <div class="p-5 border-b border-pam-gray-light flex items-center justify-between">
                        <h2 class="text-lg font-bold text-pam-blue">Upcoming Deliveries</h2>
                        <a href="#" class="text-sm font-medium text-pam-blue-light hover:text-pam-blue flex items-center gap-1">
                            View All
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="divide-y divide-pam-gray-light">
                        @if(isset($upcomingDeliveries) && $upcomingDeliveries->isNotEmpty())
                            @foreach($upcomingDeliveries as $delivery)
                            <div class="p-4 hover:bg-pam-gray-light/10 transition">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-pam-blue">#{{ $delivery->order_number ?? 'ORD-XXXX' }}</h3>
                                        <p class="text-sm text-pam-gray">
                                            @if($delivery->OrderItems->isNotEmpty() && $delivery->OrderItems->first()->product->vendor)
                                                {{ $delivery->OrderItems->first()->product->vendor->name ?? 'Vendor' }} 
                                            @else
                                                Unknown Vendor
                                            @endif
                                            → {{ $delivery->city ?? 'Location' }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Scheduled</span>
                                        <button class="text-pam-blue-light hover:text-pam-blue p-1 rounded-full hover:bg-pam-blue-light/10">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex items-center mt-3 text-sm text-pam-gray">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Scheduled for {{ $delivery->delivery_time ?? '--:--' }}
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="p-8 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No upcoming deliveries</h3>
                                <p class="mt-1 text-sm text-gray-500">You don't have any scheduled deliveries at the moment.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-rider-nav>

    <!-- Leaflet JS and Routing Plugin -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Status toggle functionality
            const toggleSwitch = document.getElementById('toggle-switch');
            const toggleCircle = document.getElementById('toggle-circle');
            const statusText = document.getElementById('status-text');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            
            // Check if online status is stored in localStorage
            const isOnline = localStorage.getItem('riderStatus') === 'online';
            
            // Set initial state
            if (isOnline) {
                setOnlineStatus(true);
            }
            
            // Toggle functionality
            toggleSwitch.addEventListener('click', function() {
                const isActive = toggleSwitch.classList.contains('bg-blue-600');
                const newStatus = !isActive;
                
                setOnlineStatus(newStatus);
                updateRiderStatus(newStatus);
            });
            
            function setOnlineStatus(isOnline) {
                if (isOnline) {
                    toggleSwitch.classList.remove('bg-gray-200');
                    toggleSwitch.classList.add('bg-blue-600');
                    toggleCircle.classList.remove('translate-x-0');
                    toggleCircle.classList.add('translate-x-5');
                    statusText.textContent = "You're currently online";
                    localStorage.setItem('riderStatus', 'online');
                } else {
                    toggleSwitch.classList.remove('bg-blue-600');
                    toggleSwitch.classList.add('bg-gray-200');
                    toggleCircle.classList.remove('translate-x-5');
                    toggleCircle.classList.add('translate-x-0');
                    statusText.textContent = "You're currently offline";
                    localStorage.setItem('riderStatus', 'offline');
                }
            }
            
            function updateRiderStatus(isOnline) {
                fetch('/rider/status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        status: isOnline ? 'online' : 'offline'
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Status updated:', data);
                    // Update UI based on server response
                    setOnlineStatus(data.status === 'online');
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                    // Revert UI if API call fails
                    const currentStatus = localStorage.getItem('riderStatus');
                    setOnlineStatus(currentStatus === 'online');
                    
                    // Show error message to user
                    alert('Failed to update status. Please try again.');
                });
            }

            // Initialize the map if delivery exists
            @if(isset($deliveries) && $deliveries->isNotEmpty())
            initMap();
            @endif

            function initMap() {
                const mapElement = document.getElementById('delivery-map');
                const loadingElement = document.getElementById('map-loading');
                
                if (!mapElement) return;
                
                // Default coordinates (Accra, Ghana)
                const defaultLocation = [5.5600, -0.2057];
                
                // Initialize the map
                const map = L.map('delivery-map').setView(defaultLocation, 13);
                
                // Add OpenStreetMap tiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                
                // Try to get the user's current location
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const userLocation = [position.coords.latitude, position.coords.longitude];
                            
                            // Center map on user's location
                            map.setView(userLocation, 15);
                            
                            // Add marker for rider's current location
                            const riderMarker = L.marker(userLocation, {
                                icon: L.divIcon({
                                    className: 'rider-marker',
                                    html: `<div style="background-color: #3B82F6; width: 16px; height: 16px; border-radius: 50%; border: 2px solid white;"></div>`,
                                    iconSize: [20, 20],
                                    iconAnchor: [10, 10]
                                })
                            }).addTo(map);
                            riderMarker.bindPopup("Your Location").openPopup();
                            
                            // Add delivery destination (this would come from your backend in a real app)
                            // For demo, we'll create a destination 5km away
                            const destination = L.latLng(
                                userLocation[0] + 0.045, 
                                userLocation[1] + 0.045
                            );
                            
                            const destinationMarker = L.marker(destination, {
                                icon: L.divIcon({
                                    className: 'destination-marker',
                                    html: `<div style="background-color: #10B981; width: 16px; height: 16px; border-radius: 50%; border: 2px solid white;"></div>`,
                                    iconSize: [20, 20],
                                    iconAnchor: [10, 10]
                                })
                            }).addTo(map);
                            destinationMarker.bindPopup("Delivery Destination");
                            
                            // Add routing control
                            L.Routing.control({
                                waypoints: [
                                    L.latLng(userLocation[0], userLocation[1]),
                                    destination
                                ],
                                routeWhileDragging: false,
                                show: false, // Hide the instructions panel
                                lineOptions: {
                                    styles: [{color: '#3B82F6', opacity: 0.7, weight: 5}]
                                },
                                createMarker: function() { return null; } // Don't create default markers
                            }).addTo(map);
                            
                            // Fit map to show both points
                            map.fitBounds([userLocation, destination]);
                            
                            // Hide loading spinner
                            if (loadingElement) {
                                loadingElement.style.display = 'none';
                            }
                            
                            // Set up navigate button
                            document.getElementById('navigate-button').addEventListener('click', function() {
                                // In a real app, you would use the actual destination coordinates
                                window.open(`https://www.openstreetmap.org/directions?engine=osrm_car&route=${userLocation[0]}%2C${userLocation[1]}%3B${destination.lat}%2C${destination.lng}#map=15/${userLocation[0]}/${userLocation[1]}`, '_blank');
                            });
                        },
                        (error) => {
                            console.error('Geolocation error:', error);
                            // If geolocation fails, use default location
                            handleLocationError(true, map, defaultLocation);
                            if (loadingElement) {
                                loadingElement.style.display = 'none';
                            }
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, map, defaultLocation);
                    if (loadingElement) {
                        loadingElement.style.display = 'none';
                    }
                }
            }
            
            function handleLocationError(browserHasGeolocation, map, pos) {
                // Show an error or just use the default position
                map.setView(pos, 13);
                
                L.marker(pos).addTo(map)
                    .bindPopup(browserHasGeolocation ?
                        "Error: The Geolocation service failed." :
                        "Error: Your browser doesn't support geolocation.")
                    .openPopup();
            }
        });
    </script>
</body>
</html>