<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor | PAM Logistics</title>
  
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
    @vite(['resources/css/app.css', 'resources/js/app.js'])
     <script src="https://cdn.tailwindcss.com"></script>
        <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pam-blue': '#1e3a8a',
                        'pam-blue-light': '#3b82f6',
                        'pam-green': '#10b981',
                        'pam-red': '#ef4444',
                        'pam-orange': '#f97316',
                        'pam-gray': '#6b7280',
                        'pam-gray-light': '#f3f4f6',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    transitionProperty: {
                        'height': 'height',
                        'spacing': 'margin, padding',
                    },
                }
            }
        }
    </script> 
    <style>
        [x-cloak] { display: none !important; }
        
        /* Smooth transitions for dropdown */
        .dropdown-enter-active, .dropdown-leave-active {
            transition: all 0.2s ease;
        }
        .dropdown-enter-from, .dropdown-leave-to {
            opacity: 0;
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="font-sans bg-pam-gray-light">
    <div class="flex h-screen" x-data="{ mobileMenuOpen: false, profileDropdownOpen: false }">
        <!-- Mobile sidebar backdrop -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden"
             @click="mobileMenuOpen = false">
        </div>

        <!-- Sidebar -->
        <div id="sidebar" 
             class="fixed inset-y-0 left-0 z-30 w-64 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-200 ease-in-out bg-white"
             :class="{ 'translate-x-0': mobileMenuOpen, '-translate-x-full': !mobileMenuOpen }">
            <div class="flex flex-col h-full border-r border-gray-200">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 px-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-pam-blue flex items-center justify-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zm10 0a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                        </div>
                        <span class="text-xl font-semibold text-pam-blue">Vendor Management</span>
                    </div>
                </div>
                
                <!-- Navigation -->
                <!-- Navigation -->
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    <nav class="space-y-1">
                        <a href="{{route('vendor.dashboard')}}" 
                        class="flex items-center px-2 py-3 text-sm font-medium rounded-md 
                                {{ request()->routeIs('vendor.dashboard') ? 'bg-pam-blue-light text-white' : 'text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{route('vendor.orders')}}" 
                        class="flex items-center px-2 py-3 text-sm font-medium rounded-md 
                                {{ request()->routeIs('vendor.orders') ? 'bg-pam-blue-light text-white' : 'text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Orders
                        </a>
                        <a href="{{route('vendor.products')}}" 
                        class="flex items-center px-2 py-3 text-sm font-medium rounded-md 
                                {{ request()->routeIs('vendor.products') ? 'bg-pam-blue-light text-white' : 'text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Products
                        </a>
                        <a href="{{route('vendor.analytic')}}" 
                        class="flex items-center px-2 py-3 text-sm font-medium rounded-md 
                                {{ request()->routeIs('vendor.analytic') ? 'bg-pam-blue-light text-white' : 'text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Analytics
                        </a>
                        <a href="{{route('vendor.payments')}}" 
                        class="flex items-center px-2 py-3 text-sm font-medium rounded-md 
                                {{ request()->routeIs('vendor.payments') ? 'bg-pam-blue-light text-white' : 'text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Payments
                        </a>
                    </nav>
                </div>
                
                <!-- User Profile -->
                {{-- <div class="p-4 border-t border-pam-gray-light bg-white">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                @click.outside="open = false"
                                class="flex items-center w-full focus:outline-none group"
                                aria-haspopup="true" 
                                :aria-expanded="open">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full object-cover" 
                                     src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=7F9CF5&background=EBF4FF' }}" 
                                     alt="{{ auth()->user()->name }}">
                            </div>
                            <div class="ml-3 text-left flex-1 min-w-0">
                                <p class="text-sm font-medium text-pam-blue truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs font-medium text-pam-gray truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <svg class="ml-2 h-5 w-5 text-pam-gray flex-shrink-0 transition-transform duration-200" 
                                 :class="{ 'transform rotate-180': open }" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="origin-top-right absolute left-0 right-0 md:right-auto md:left-0 mt-2 w-full md:w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                             role="menu"
                             aria-orientation="vertical"
                             style="display: none;">
                            <div class="py-1" role="none">
                                <a href="" 
                                   class="flex items-center px-4 py-2 text-sm text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue transition-colors"
                                   role="menuitem">
                                    <svg class="mr-3 h-5 w-5 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile
                                </a>
                                <a href="" 
                                   class="flex items-center px-4 py-2 text-sm text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue transition-colors"
                                   role="menuitem">
                                    <svg class="mr-3 h-5 w-5 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Settings
                                </a>
                                <form method="POST" action="" role="none">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full flex items-center px-4 py-2 text-sm text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue transition-colors"
                                            role="menuitem">
                                        <svg class="mr-3 h-5 w-5 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Mobile header -->
            <div class="md:hidden flex items-center justify-between px-4 py-3 bg-white border-b border-pam-gray-light">
                <div class="flex items-center">
                    <button @click="mobileMenuOpen = true" 
                            class="text-pam-gray hover:text-pam-blue focus:outline-none"
                            aria-label="Open menu">
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
                <div class="flex items-center space-x-4">
                    <!-- Mobile profile dropdown (simplified) -->
                    <div class="relative" x-data="{ mobileProfileOpen: false }">
                        <button @click="mobileProfileOpen = !mobileProfileOpen"
                                @click.outside="mobileProfileOpen = false"
                                class="flex items-center text-sm rounded-full focus:outline-none"
                                aria-expanded="false"
                                aria-haspopup="true">
                            <img class="h-8 w-8 rounded-full" 
                                 src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=7F9CF5&background=EBF4FF' }}" 
                                 alt="{{ auth()->user()->name }}">
                        </button>
                        
                        <div x-show="mobileProfileOpen"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                             role="menu"
                             aria-orientation="vertical"
                             style="display: none;">
                            <a href="{{route('profile')}}" class="block px-4 py-2 text-sm text-pam-gray hover:bg-pam-gray-light" role="menuitem">Profile</a>
                                   <a href="" class="block px-4 py-2 text-sm text-pam-gray hover:bg-pam-gray-light" role="menuitem">Settings</a>
                            <form method="POST" action="{{ route('logout') }}" role="none">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-pam-gray hover:bg-pam-gray-light" role="menuitem">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Desktop header -->
            <div class="hidden md:flex items-center justify-between px-6 py-3 bg-white border-b border-pam-gray-light">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-pam-gray">Vendor Dashboard</h1>
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
                    
                    <!-- Desktop profile dropdown -->
                    <div class="relative" x-data="{ desktopProfileOpen: false }">
                        <button @click="desktopProfileOpen = !desktopProfileOpen"
                                @click.outside="desktopProfileOpen = false"
                                class="flex items-center text-sm rounded-full focus:outline-none"
                                aria-expanded="false"
                                aria-haspopup="true">
                            <img class="h-8 w-8 rounded-full" 
                                 src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=7F9CF5&background=EBF4FF' }}" 
                                 alt="{{ auth()->user()->name }}">
                            <span class="ml-2 text-sm font-medium text-pam-gray hidden md:inline">{{ auth()->user()->name }}</span>
                            <svg class="ml-1 h-4 w-4 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <div x-show="desktopProfileOpen"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                             role="menu"
                             aria-orientation="vertical"
                             style="display: none;">
                            <div class="px-4 py-2">
                                <p class="text-sm text-pam-blue font-medium">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-pam-gray truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="border-t border-gray-100"></div>
                            <a href="{{route('profile')}}" class="block px-4 py-2 text-sm text-pam-gray hover:bg-pam-gray-light" role="menuitem">Profile</a>
                            <a href="" class="block px-4 py-2 text-sm text-pam-gray hover:bg-pam-gray-light" role="menuitem">Settings</a>
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}" role="none">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-pam-gray hover:bg-pam-gray-light" role="menuitem">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main content area -->
            <div class="flex-1 overflow-y-auto p-4 md:p-6">
                {{$slot}}     
            </div>
        </div>
    </div>

    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>