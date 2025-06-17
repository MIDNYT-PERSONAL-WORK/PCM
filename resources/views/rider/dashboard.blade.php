<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Dashboard | PAM Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pam-blue': '#1e3a8a',
                        'pam-blue-light': '#3b82f6',
                        'pam-green': '#10b981',
                        'pam-gray': '#6b7280',
                        'pam-gray-light': '#f3f4f6',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .map-container {
            height: 400px;
            background-color: #e5e7eb;
            position: relative;
            overflow: hidden;
        }
        
        .current-location {
            position: absolute;
            width: 16px;
            height: 16px;
            background-color: #3b82f6;
            border-radius: 50%;
            border: 2px solid white;
        }
        
        .delivery-location {
            position: absolute;
            width: 12px;
            height: 12px;
            background-color: #10b981;
            border-radius: 50%;
            border: 2px solid white;
        }
        
        .route-line {
            position: absolute;
            height: 2px;
            background-color: #3b82f6;
            transform-origin: left center;
        }
    </style>
</head>
<body class="font-sans bg-pam-gray-light">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-white border-r border-gray-200">
                <!-- Logo -->
                <div class="flex items-center h-16 px-4 border-b border-pam-gray-light">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-pam-blue flex items-center justify-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zm10 0a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                        </div>
                        <span class="text-lg font-semibold text-pam-blue">PAM Logistics</span>
                    </div>
                </div>
                
                <!-- Navigation -->
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    <nav class="space-y-1">
                        <a href="#" class="flex items-center px-2 py-3 text-sm font-medium rounded-md bg-pam-blue-light text-white">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="#" class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            My Deliveries
                        </a>
                        <a href="#" class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Performance
                        </a>
                        <a href="#" class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Earnings
                        </a>
                        <a href="#" class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </a>
                    </nav>
                </div>
                
                <!-- User Profile -->
                <div class="p-4 border-t border-pam-gray-light">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Rider profile">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-pam-blue">Rider User</p>
                            <p class="text-xs font-medium text-pam-gray">rider@pamlogistics.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Mobile header -->
            <div class="md:hidden flex items-center justify-between px-4 py-3 bg-white border-b border-pam-gray-light">
                <div class="flex items-center">
                    <button class="text-pam-gray hover:text-pam-blue focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="ml-2 flex items-center">
                        <div class="w-6 h-6 rounded-lg bg-pam-blue flex items-center justify-center mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zm10 0a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                        </div>
                        <span class="text-lg font-semibold text-pam-blue">PAM Logistics</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <button class="p-1 text-pam-gray hover:text-pam-blue focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Desktop header -->
            <div class="hidden md:flex items-center justify-between px-6 py-3 bg-white border-b border-pam-gray-light">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-pam-gray">Rider Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="px-4 py-2 text-sm font-medium rounded-lg shadow-sm text-white bg-pam-blue hover:bg-pam-blue-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue-light transition">
                        Go Online
                    </button>
                    <button class="p-1 text-pam-gray hover:text-pam-blue focus:outline-none relative">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-pam-green"></span>
                    </button>
                    <div class="flex items-center">
                        <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Rider profile">
                        <span class="ml-2 text-sm font-medium text-pam-gray hidden md:inline">Rider User</span>
                    </div>
                </div>
            </div>
            
            <!-- Main content area -->
            <div class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Today's Deliveries</p>
                                <p class="text-2xl font-semibold text-pam-blue">8</p>
                                <p class="text-xs text-pam-gray">Completed: 6</p>
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
                                <p class="text-sm font-medium text-pam-gray">Today's Earnings</p>
                                <p class="text-2xl font-semibold text-pam-blue">$86.50</p>
                                <p class="text-xs text-pam-green flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    12% from yesterday
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
                                <p class="text-sm font-medium text-pam-gray">Avg. Delivery Time</p>
                                <p class="text-2xl font-semibold text-pam-blue">38m</p>
                                <p class="text-xs text-pam-gray">From pickup to delivery</p>
                            </div>
                            <div class="p-3 rounded-lg bg-pam-blue/10 text-pam-blue">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Current Rating</p>
                                <p class="text-2xl font-semibold text-pam-blue">4.8</p>
                                <p class="text-xs text-pam-gray">From 124 ratings</p>
                            </div>
                            <div class="p-3 rounded-lg bg-yellow-100/10 text-yellow-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Current Delivery -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Map -->
                    <div class="lg:col-span-2 bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-pam-gray">Delivery Navigation</h2>
                            <div class="flex items-center space-x-2">
                                <button class="px-3 py-1 text-sm border border-pam-gray-light rounded-lg bg-white hover:bg-pam-gray-light">Details</button>
                                <button class="px-3 py-1 text-sm border border-pam-gray-light rounded-lg bg-pam-blue-light text-white">Navigate</button>
                            </div>
                        </div>
                        <div class="map-container rounded-lg">
                            <!-- These would be dynamically positioned in a real app -->
                            <div class="current-location" style="top: 50%; left: 40%;"></div>
                            <div class="delivery-location" style="top: 30%; left: 70%;"></div>
                            <div class="route-line" style="width: 30%; top: 40%; left: 45%; transform: rotate(30deg);"></div>
                        </div>
                    </div>
                    
                    <!-- Delivery Details -->
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium text-pam-gray">Current Delivery</h2>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pam-blue-light/10 text-pam-blue-light">In Progress</span>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Order ID</p>
                                <p class="text-base text-pam-blue">#ORD-7841</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-pam-gray">From</p>
                                <p class="text-base text-pam-gray">Fresh Groceries</p>
                                <p class="text-sm text-pam-gray">123 Market St, Downtown</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-pam-gray">To</p>
                                <p class="text-base text-pam-gray">John Smith</p>
                                <p class="text-sm text-pam-gray">456 Residential Ave, Apt 3B</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-pam-gray">Items</p>
                                <ul class="text-sm text-pam-gray list-disc list-inside">
                                    <li>Grocery Bag (3 items)</li>
                                    <li>Dairy Box (2 items)</li>
                                </ul>
                            </div>
                            <div class="pt-4 border-t border-pam-gray-light">
                                <button class="w-full py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-pam-green hover:bg-pam-green/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-green transition">
                                    Mark as Delivered
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Next Deliveries -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-pam-gray">Next Deliveries</h2>
                        <a href="#" class="text-sm font-medium text-pam-blue-light hover:text-pam-blue">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-pam-gray-light">
                            <thead class="bg-pam-gray-light/50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Order ID</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Vendor</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Destination</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-pam-gray-light">
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7842</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">ElectroHub</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">789 Tech Park</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Scheduled</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">
                                        <button class="text-pam-blue-light hover:text-pam-blue">Start</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7843</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">Fashion Boutique</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">321 Mall Rd</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Scheduled</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">
                                        <button class="text-pam-blue-light hover:text-pam-blue">Start</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pam-blue">#ORD-7844</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">Book Haven</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">654 Library Lane</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Scheduled</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-pam-gray">
                                        <button class="text-pam-blue-light hover:text-pam-blue">Start</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>