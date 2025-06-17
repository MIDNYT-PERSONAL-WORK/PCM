<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAM Logistics - Sign In</title>
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
                        'pam-gray-light': '#f3f6f6',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .role-tab.active {
            border-bottom: 2px solid #3b82f6;
            color: #1e3a8a;
            font-weight: 500;
        }
        .auth-switcher .active {
            background: white;
            color: #1e3a8a;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="font-sans bg-white" x-data="{ activeRole: 'rider', isLogin: true }">
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

            <!-- Auth Switcher -->
            <div class="flex bg-pam-gray-light rounded-lg p-1 mb-6 auth-switcher">
                <button 
                    @click="isLogin = true" 
                    :class="{ 'active': isLogin }"
                    class="flex-1 py-2 text-sm font-medium rounded-md transition-all">
                    Sign In
                </button>
                <button 
                    @click="isLogin = false" 
                    :class="{ 'active': !isLogin }"
                    class="flex-1 py-2 text-sm font-medium rounded-md transition-all">
                    Create Account
                </button>
            </div>

            <!-- Role Selection -->
            

            <!-- Sign In Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4" x-show="isLogin">
                @csrf
                <div class="mb-6" x-show="isLogin">

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
                    <h2 class="text-sm font-medium text-pam-gray mb-3">Login as:</h2>
                    {{-- <div class="hidden sm:flex border-b border-pam-gray-light pb-1 gap-1" role="tablist">
                        <button 
                            type="button" 
                            class="role-tab px-4 py-2 text-sm font-medium transition-all"
                            :class="{ 'active': activeRole === 'admin' }"
                            @click="activeRole = 'admin'">
                            Admin
                        </button>
                        <button 
                            type="button" 
                            class="role-tab px-4 py-2 text-sm font-medium transition-all"
                            :class="{ 'active': activeRole === 'vendor' }"
                            @click="activeRole = 'vendor'">
                            Vendor
                        </button>
                        <button 
                            type="button" 
                            class="role-tab px-4 py-2 text-sm font-medium transition-all"
                            :class="{ 'active': activeRole === 'operator' }"
                            @click="activeRole = 'operator'">
                            Operator
                        </button>
                        <button 
                            type="button" 
                            class="role-tab px-4 py-2 text-sm font-medium transition-all"
                            :class="{ 'active': activeRole === 'rider' }"
                            @click="activeRole = 'rider'">
                            Rider
                        </button>
                    </div> --}}
                    
                    <!-- Mobile dropdown -->
                    {{-- <select name="role" class="sm:hidden mt-1 block w-full pl-3 pr-10 py-3 text-base border border-pam-gray-light focus:outline-none focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light rounded-lg transition"
                        x-model="activeRole">
                        <option value="admin">Admin</option>
                        <option value="vendor">Vendor</option>
                        <option value="operator">Operator</option>
                        <option value="rider">Rider</option>
                    </select> --}}
                </div>

                <!-- Hidden input to send role to backend -->
                <input type="hidden" name="role" :value="activeRole">

                <div>
                    <label for="email" class="block text-sm font-medium text-pam-gray">Email address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="w-full px-4 py-3 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-pam-gray">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                            class="w-full px-4 py-3 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
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
                        {{-- Sign in as <span class="capitalize ml-1" x-text="activeRole"></span> --}}
                        Sign in as 
                    </button>
                </div>
            </form>

            <!-- Sign Up Form -->
            <form class="space-y-4" x-show="!isLogin">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                    <div>
                        <label for="first-name" class="block text-sm font-medium text-pam-gray">First name</label>
                        <div class="mt-1">
                            <input id="first-name" name="first-name" type="text" autocomplete="given-name" required 
                                class="w-full px-4 py-3 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        </div>
                    </div>
                    <div>
                        <label for="last-name" class="block text-sm font-medium text-pam-gray">Last name</label>
                        <div class="mt-1">
                            <input id="last-name" name="last-name" type="text" autocomplete="family-name" required 
                                class="w-full px-4 py-3 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-pam-gray">Email address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="w-full px-4 py-3 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    </div>
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-pam-gray">Phone number</label>
                    <div class="mt-1">
                        <input id="phone" name="phone" type="tel" autocomplete="tel" required 
                            class="w-full px-4 py-3 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    </div>
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-pam-gray">Role</label>
                    <div class="mt-1">
                        <select id="role" name="role" required
                            class="w-full px-4 py-3 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                            <option value="" disabled selected>Select a role</option>
                            {{-- <option value="admin">Admin</option> --}}
                            <option value="vendor">Vendor</option>
                            <option value="operator">Operator</option>
                            <option value="rider">Rider</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-pam-gray">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="new-password" required 
                            class="w-full px-4 py-3 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        <p class="mt-1 text-xs text-pam-gray">Minimum 8 characters with at least one number</p>
                    </div>
                </div>

                <div>
                    <label for="confirm-password" class="block text-sm font-medium text-pam-gray">Confirm Password</label>
                    <div class="mt-1">
                        <input id="confirm-password" name="confirm-password" type="password" autocomplete="new-password" required 
                            class="w-full px-4 py-3 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required
                        class="h-4 w-4 text-pam-blue-light focus:ring-pam-blue-light border-pam-gray-light rounded">
                    <label for="terms" class="ml-2 block text-sm text-pam-gray">
                        I agree to the <a href="#" class="text-pam-blue-light hover:text-pam-blue">Terms of Service</a> and <a href="#" class="text-pam-blue-light hover:text-pam-blue">Privacy Policy</a>
                    </label>
                </div>

                <div>
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-pam-blue hover:bg-pam-blue-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue-light transition">
                        Create Account
                    </button>
                </div>
            </form>

            <!-- Social Login -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-pam-gray-light"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-pam-gray">
                            Or continue with
                        </span>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-3">
                    <div>
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-pam-gray-light rounded-lg shadow-sm bg-white text-sm font-medium text-pam-gray hover:bg-pam-gray-light transition">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 48 48">
                                <g>
                                    <path fill="#4285F4" d="M44.5 20H24v8.5h11.7C34.6 32.9 30.1 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.5 5.1 29.6 3 24 3 12.4 3 3 12.4 3 24s9.4 21 21 21c10.5 0 20-7.6 20-21 0-1.3-.1-2.7-.3-4z"/>
                                    <path fill="#34A853" d="M6.3 14.7l7 5.1C15.5 16.2 19.4 13 24 13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.5 5.1 29.6 3 24 3c-7.6 0-14.1 4.2-17.7 10.7z"/>
                                    <path fill="#FBBC05" d="M24 45c5.6 0 10.5-1.9 14.3-5.2l-6.6-5.4C29.7 36.1 27 37 24 37c-6.1 0-10.6-3.1-12.7-7.6l-7 5.4C9.9 41.1 16.4 45 24 45z"/>
                                    <path fill="#EA4335" d="M44.5 20H24v8.5h11.7c-1.1 3.1-4.1 5.5-7.7 5.5-2.2 0-4.2-.7-5.7-2l-7 5.4C19.4 44.1 24 45 24 45c10.5 0 20-7.6 20-21 0-1.3-.1-2.7-.3-4z"/>
                                </g>
                            </svg>
                            Google
                        </a>
                    </div>
                    <div>
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-pam-gray-light rounded-lg shadow-sm bg-white text-sm font-medium text-pam-gray hover:bg-pam-gray-light transition">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                <path fill="#1877F2" d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073c0 6.019 4.388 10.995 10.125 11.854v-8.385H7.078v-3.47h3.047V9.413c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.513c-1.491 0-1.953.926-1.953 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.068 24 18.092 24 12.073"/>
                            </svg>
                            Facebook
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-8 text-center text-xs text-pam-gray">
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
                    <h2 class="text-3xl font-bold mb-4" x-text="isLogin ? 'Welcome Back to PAM Logistics' : 'Join PAM Logistics Today'"></h2>
                    <p class="text-lg opacity-90" x-text="isLogin ? 'Sign in to manage your delivery operations and access your dashboard.' : 'Create your account to start managing your logistics operations efficiently.'"></p>
                </div>
                
                <!-- Role-specific benefits -->
                <div class="mt-8 space-y-4" x-show="isLogin">
                    <div x-show="activeRole === 'admin'" class="p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <h3 class="font-medium mb-1">Admin Dashboard</h3>
                        <p class="text-sm opacity-80">Full system control and analytics</p>
                    </div>
                    <div x-show="activeRole === 'vendor'" class="p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <h3 class="font-medium mb-1">Vendor Portal</h3>
                        <p class="text-sm opacity-80">Manage your shipments and track deliveries</p>
                    </div>
                    <div x-show="activeRole === 'operator'" class="p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <h3 class="font-medium mb-1">Operations Center</h3>
                        <p class="text-sm opacity-80">Coordinate logistics and dispatch riders</p>
                    </div>
                    <div x-show="activeRole === 'rider'" class="p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <h3 class="font-medium mb-1">Rider App</h3>
                        <p class="text-sm opacity-80">Efficient route planning and delivery tracking</p>
                    </div>
                </div>

                <!-- Sign Up Benefits -->
                <div class="mt-8 space-y-4" x-show="!isLogin">
                    <div class="p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <h3 class="font-medium mb-1">Real-time Tracking</h3>
                        <p class="text-sm opacity-80">Monitor all your shipments in real-time</p>
                    </div>
                    <div class="p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <h3 class="font-medium mb-1">Automated Dispatch</h3>
                        <p class="text-sm opacity-80">Smart algorithms optimize your deliveries</p>
                    </div>
                    <div class="p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <h3 class="font-medium mb-1">Comprehensive Reporting</h3>
                        <p class="text-sm opacity-80">Get insights into your operations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>