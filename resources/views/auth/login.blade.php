<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAM Logistics - Login</title>
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
                    boxShadow: {
                        'tab-active': '0 2px 0px -1px rgba(59, 130, 246, 0.5)',
                    }
                }
            }
        }
    </script>
    <style>
        .role-tab.active {
            border-bottom: 2px solid #3b82f6;
            box-shadow: 0 2px 0px -1px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>
<body class="font-sans bg-white" x-data="{ activeRole: 'rider' }">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Form Section -->
        <div class="w-full lg:w-1/2 p-8 md:p-12 lg:p-20 flex flex-col justify-center">
            <!-- Logo -->
            <div class="mb-6 text-center lg:text-left">
                <div class="flex items-center justify-center lg:justify-start">
                    <div class="w-12 h-12 rounded-lg bg-pam-blue flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zm10 0a2 2 0 11-4 0 2 2 0 014 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-pam-blue">PAM Logistics</h1>
                </div>
                <p class="mt-2 text-pam-gray">Efficient delivery management system</p>
            </div>

            <!-- Role Selection - Desktop & Mobile -->
            {{-- <div class="mb-8">
                <h2 class="text-sm font-medium text-pam-gray mb-3">Login as:</h2>
                <div class="hidden sm:flex border-b border-pam-gray-light pb-1" role="tablist">
                    <button 
                        type="button" 
                        role="tab"
                        class="role-tab px-4 py-2 text-sm font-medium transition-all relative"
                        :class="{
                            'active text-pam-blue': activeRole === 'admin',
                            'text-pam-gray hover:text-pam-blue-light': activeRole !== 'admin'
                        }"
                        @click="activeRole = 'admin'"
                        aria-selected="activeRole === 'admin'">
                        Admin
                    </button>
                    <button 
                        type="button" 
                        role="tab"
                        class="role-tab px-4 py-2 text-sm font-medium transition-all relative"
                        :class="{
                            'active text-pam-blue': activeRole === 'vendor',
                            'text-pam-gray hover:text-pam-blue-light': activeRole !== 'vendor'
                        }"
                        @click="activeRole = 'vendor'"
                        aria-selected="activeRole === 'vendor'">
                        Vendor
                    </button>
                    <button 
                        type="button" 
                        role="tab"
                        class="role-tab px-4 py-2 text-sm font-medium transition-all relative"
                        :class="{
                            'active text-pam-blue': activeRole === 'operator',
                            'text-pam-gray hover:text-pam-blue-light': activeRole !== 'operator'
                        }"
                        @click="activeRole = 'operator'"
                        aria-selected="activeRole === 'operator'">
                        Operator
                    </button>
                    <button 
                        type="button" 
                        role="tab"
                        class="role-tab px-4 py-2 text-sm font-medium transition-all relative"
                        :class="{
                            'active text-pam-blue': activeRole === 'rider',
                            'text-pam-gray hover:text-pam-blue-light': activeRole !== 'rider'
                        }"
                        @click="activeRole = 'rider'"
                        aria-selected="activeRole === 'rider'">
                        Rider
                    </button>
                </div>
                
                <!-- Mobile dropdown fallback -->
                <select class="sm:hidden mt-1 block w-full pl-3 pr-10 py-3 text-base border border-pam-gray-light focus:outline-none focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light rounded-lg transition"
                    x-model="activeRole">
                    <option value="admin">Admin</option>
                    <option value="vendor">Vendor</option>
                    <option value="operator">Operator</option>
                    <option value="rider">Rider</option>
                </select>
            </div> --}}

            <!-- Login Form -->
            <form class="space-y-6" action="{{ route('login') }}" method="POST" >
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-pam-gray">Email address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="w-full px-4 py-3 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-pam-gray">Password</label>
                    <div class="mt-1 relative">
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="current-password" 
                            required 
                            class="w-full px-4 py-3 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition pr-12"
                        >
                        <button 
                            type="button" 
                            tabindex="-1"
                            id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-pam-gray hover:text-pam-blue-light focus:outline-none"
                        >
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95m3.25-2.568A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.965 9.965 0 01-4.293 5.032M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 6L6 6" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" 
                            class="h-4 w-4 text-pam-blue-light focus:ring-pam-blue-light border-pam-gray-light rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-pam-gray">Remember me</label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-pam-blue-light hover:text-pam-blue">Forgot password?</a>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-pam-blue hover:bg-pam-blue-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue-light transition">
                        Sign in
                    </button>
                </div>
            </form>

            <!-- Copyright -->
            <div class="mt-12 text-center text-xs text-pam-gray">
                &copy; 2023 PAM Logistics. All rights reserved.
            </div>
        </div>

        <!-- Image Section -->
        <div class="hidden lg:block lg:w-1/2 relative">
            <!-- Gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-pam-blue/20 to-pam-blue/60 z-10"></div>
            
            <!-- Background image -->
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1603138461420-e24168721842?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80')"></div>
            
            <!-- Content overlay -->
            <div class="relative z-20 h-full flex flex-col justify-between p-12 text-white">
                <!-- Text content -->
                <div class="max-w-md">
                    <h2 class="text-3xl font-bold mb-4">Optimize Your Delivery Network</h2>
                    <p class="text-lg opacity-90">PAM Logistics provides a comprehensive platform to manage all aspects of your delivery operations, from warehouse to last-mile.</p>
                </div>
                
                <!-- Role-specific benefits -->
                <div class="mt-8 space-y-4">
                    {{-- <div x-show="activeRole === 'rider'" class="p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <h3 class="font-medium mb-1">Admin Dashboard</h3>
                        <p class="text-sm opacity-80">Full system control and analytics</p>
                    </div> --}}
                    <div x-show="activeRole === 'rider'" class="p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <h3 class="font-medium mb-1">Vendor Portal</h3>
                        <p class="text-sm opacity-80">Manage your shipments and track deliveries</p>
                    </div>
                    <div x-show="activeRole === 'rider'" class="p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <h3 class="font-medium mb-1">Operations Center</h3>
                        <p class="text-sm opacity-80">Coordinate logistics and dispatch riders</p>
                    </div>
                    <div x-show="activeRole === 'rider'" class="p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <h3 class="font-medium mb-1">Rider App</h3>
                        <p class="text-sm opacity-80">Efficient route planning and delivery tracking</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>    <!-- Show/hide password JS -->
    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('hidden');
            eyeOffIcon.classList.toggle('hidden');
        });
    </script>
    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>