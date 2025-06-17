<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Dashboard | PAM Logistics</title>
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
        
        .rider-marker {
            position: absolute;
            width: 16px;
            height: 16px;
            background-color: #3b82f6;
            border-radius: 50%;
            border: 2px solid white;
        }
        
        .delivery-marker {
            position: absolute;
            width: 12px;
            height: 12px;
            background-color: #10b981;
            border-radius: 50%;
            border: 2px solid white;
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
                            Orders
                        </a>
                        <a href="#" class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Dispatch
                        </a>
                        <a href="#" class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Riders
                        </a>
                        <a href="#" class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Vendors
                        </a>
                    </nav>
                </div>
                
                <!-- User Profile -->
                <div class="p-4 border-t border-pam-gray-light">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Operator profile">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-pam-blue">Operator User</p>
                            <p class="text-xs font-medium text-pam-gray">operator@pamlogistics.com</p>
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
                    <h1 class="text-xl font-semibold text-pam-gray">Operator Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        <div class="absolute left-3 top-2.5 text-pam-gray">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <button class="p-1 text-pam-gray hover:text-pam-blue focus:outline-none relative">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-pam-green"></span>
                    </button>
                    <div class="flex items-center">
                        <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Operator profile">
                        <span class="ml-2 text-sm font-medium text-pam-gray hidden md:inline">Operator User</span>
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
    </div>
</body>
</html>