<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Inventory | PAM Logistics</title>
     <script src="https://cdn.tailwindcss.com"></script> 
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-pam-gray-light">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-pam-blue flex items-center justify-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zm10 0a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                        </div>
                        <span class="text-xl font-semibold text-pam-blue">PAM Logistics</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    {{-- <a href="" class="text-pam-gray hover:text-pam-blue px-3 py-2 text-sm font-medium">Login</a> --}}
                    <a href="{{route('LoginSignup')}}" class="bg-pam-blue text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-pam-blue-light transition">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-pam-blue mb-2">Our Inventory</h1>
            <p class="text-pam-gray">Browse through our wide selection of products available for delivery</p>
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-pam-gray"></i>
                    </div>
                    <input type="text" class="block w-full pl-10 pr-3 py-2 border border-pam-gray-light rounded-md focus:ring-pam-blue focus:border-pam-blue" placeholder="Search products...">
                </div>
                <div class="flex items-center space-x-4">
                    <select class="border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                        <option>All Categories</option>
                        <option>Electronics</option>
                        <option>Groceries</option>
                        <option>Medicines</option>
                        <option>Documents</option>
                    </select>
                    <select class="border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                        <option>Sort by: Newest</option>
                        <option>Sort by: Price (Low to High)</option>
                        <option>Sort by: Price (High to Low)</option>
                        <option>Sort by: Most Popular</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Inventory Grid -->
        <div class=" ">
            <!-- Product Card 1 -->
           {{$slot}}
         
        
        </div>
        </div>

        <footer class="w-full mt-auto">
            <x-guest.footer/>
        </footer>

   
    
    </div>


</body>
</html>