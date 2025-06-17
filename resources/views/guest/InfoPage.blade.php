<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Supplies | PAM Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pam-blue': '#1e3a8a',
                        'pam-blue-light': '#3b82f6',
                        'pam-green': '#10b981',
                        'pam-red': '#ef4444',
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
        .image-zoom-container {
            position: relative;
            overflow: hidden;
            cursor: zoom-in;
        }
        .image-zoom-container img {
            transition: transform 0.3s;
        }
        .image-zoom-container:hover img {
            transform: scale(1.05);
        }
    </style>
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
                    <a href="#" class="text-pam-gray hover:text-pam-blue px-3 py-2 text-sm font-medium">Login</a>
                    <a href="#" class="bg-pam-blue text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-pam-blue-light transition">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <a href="/inventory" class="inline-flex items-center text-pam-blue-light hover:text-pam-blue mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Back to Inventory
        </a>

        <!-- Product Detail -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="md:flex">
                <!-- Product Images -->
                <div class="md:w-1/2 p-6">
                    <div class="relative image-zoom-container">
                        <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Medical Supplies" class="w-full h-auto rounded-lg">
                        <button id="likeButton" class="absolute top-4 right-4 bg-white rounded-full p-3 shadow-md hover:bg-pam-gray-light transition" aria-label="Like this item">
                            <i id="heartIcon" class="far fa-heart text-2xl text-pam-red"></i>
                            <span id="likeCount" class="absolute -bottom-2 -right-2 bg-pam-red text-white text-xs rounded-full h-6 w-6 flex items-center justify-center">42</span>
                        </button>
                    </div>
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Medical supplies thumbnail 1" class="h-20 object-cover rounded cursor-pointer border-2 border-transparent hover:border-pam-blue">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Medical supplies thumbnail 2" class="h-20 object-cover rounded cursor-pointer border-2 border-transparent hover:border-pam-blue">
                        <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Medical supplies thumbnail 3" class="h-20 object-cover rounded cursor-pointer border-2 border-transparent hover:border-pam-blue">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Medical supplies thumbnail 4" class="h-20 object-cover rounded cursor-pointer border-2 border-transparent hover:border-pam-blue">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="md:w-1/2 p-6">
                    <div class="border-b border-pam-gray-light pb-4 mb-4">
                        <h1 class="text-2xl font-bold text-pam-blue mb-2">Medical Supplies</h1>
                        <div class="flex items-center mb-2">
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star-half-alt text-yellow-400"></i>
                                <span class="text-pam-gray ml-2">4.5 (24 reviews)</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-pam-blue">₦25,000</span>
                            <span class="bg-pam-green text-white text-sm px-2 py-1 rounded-full">In Stock</span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-pam-blue mb-2">Description</h3>
                        <p class="text-pam-gray">Essential medical equipment package including first aid kits, protective gear, and basic diagnostic tools. Perfect for clinics, offices, and home use. All items are sterilized and packed according to medical standards.</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-pam-blue mb-2">Details</h3>
                        <ul class="text-pam-gray space-y-1">
                            <li><span class="font-medium">Category:</span> Medical</li>
                            <li><span class="font-medium">Weight:</span> 5.2 kg</li>
                            <li><span class="font-medium">Dimensions:</span> 30 × 20 × 15 cm</li>
                            <li><span class="font-medium">Delivery Time:</span> Same day available</li>
                            <li><span class="font-medium">Vendor:</span> MedEquip Nigeria</li>
                            <li><span class="font-medium">Manufacturer:</span> Global Medical Supplies Ltd.</li>
                            <li><span class="font-medium">Expiry Date:</span> 2025-12-31</li>
                        </ul>
                    </div>

                    <!-- Like and Share -->
                    <div class="flex items-center space-x-4 mb-6">
                        <button id="likeButton2" class="flex items-center text-pam-gray hover:text-pam-red" aria-label="Like this item">
                            <i id="heartIcon2" class="far fa-heart mr-1"></i>
                            <span id="likeCount2">Like (42)</span>
                        </button>
                        <button class="flex items-center text-pam-gray hover:text-pam-blue" aria-label="Share this item">
                            <i class="fas fa-share-alt mr-1"></i>
                            <span>Share</span>
                        </button>
                    </div>

                    <!-- Delivery Calculator -->
                    <div class="bg-pam-gray-light p-4 rounded-lg mb-6">
                        <h3 class="text-lg font-semibold text-pam-blue mb-3">Calculate Delivery</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="fromLocation" class="block text-sm font-medium text-pam-gray mb-1">From Location</label>
                                <select id="fromLocation" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                                    <option>Lagos</option>
                                    <option>Abuja</option>
                                    <option>Port Harcourt</option>
                                    <option>Kano</option>
                                </select>
                            </div>
                            <div>
                                <label for="toLocation" class="block text-sm font-medium text-pam-gray mb-1">To Location</label>
                                <select id="toLocation" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                                    <option>Select destination</option>
                                    <option>Lagos</option>
                                    <option>Abuja</option>
                                    <option>Port Harcourt</option>
                                    <option>Kano</option>
                                </select>
                            </div>
                        </div>
                        <button class="mt-3 w-full bg-pam-blue text-white py-2 rounded-md hover:bg-pam-blue-light transition">Calculate Cost</button>
                    </div>

                    <!-- Call to Action -->
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                        <button class="flex-1 bg-pam-blue text-white py-3 px-4 rounded-md hover:bg-pam-blue-light transition font-medium">
                            <i class="fas fa-phone-alt mr-2"></i> Contact Vendor
                        </button>
                        <button class="flex-1 border border-pam-blue text-pam-blue py-3 px-4 rounded-md hover:bg-pam-gray-light transition font-medium">
                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information Tabs -->
        <div class="mt-8 bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="border-b border-pam-gray-light">
                <nav class="flex -mb-px">
                    <button class="tab-button active py-4 px-6 text-center border-b-2 font-medium text-sm border-pam-blue text-pam-blue">
                        Specifications
                    </button>
                    <button class="tab-button py-4 px-6 text-center border-b-2 font-medium text-sm border-transparent text-pam-gray hover:text-pam-blue hover:border-pam-gray-light">
                        Features
                    </button>
                    <button class="tab-button py-4 px-6 text-center border-b-2 font-medium text-sm border-transparent text-pam-gray hover:text-pam-blue hover:border-pam-gray-light">
                        Documentation
                    </button>
                </nav>
            </div>
            <div class="p-6">
                <div class="tab-content active">
                    <h3 class="text-lg font-semibold text-pam-blue mb-3">Technical Specifications</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-medium text-pam-blue mb-2">Package Contents</h4>
                            <ul class="list-disc list-inside text-pam-gray space-y-1">
                                <li>First aid kit (50 pieces)</li>
                                <li>Surgical masks (box of 50)</li>
                                <li>Disposable gloves (box of 100)</li>
                                <li>Thermometer (digital)</li>
                                <li>Blood pressure monitor</li>
                                <li>Bandages and dressings</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-medium text-pam-blue mb-2">Certifications</h4>
                            <ul class="list-disc list-inside text-pam-gray space-y-1">
                                <li>NAFDAC Approved</li>
                                <li>ISO 13485 Certified</li>
                                <li>CE Marked</li>
                                <li>FDA Registered</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content hidden">
                    <!-- Features content would go here -->
                </div>
                <div class="tab-content hidden">
                    <!-- Documentation content would go here -->
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-8 bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-pam-blue mb-6">Customer Reviews</h2>
            
            <div class="space-y-6">
                <!-- Review 1 -->
                <div class="border-b border-pam-gray-light pb-6">
                    <div class="flex items-center mb-2">
                        <div class="w-10 h-10 rounded-full bg-pam-gray-light flex items-center justify-center mr-3">
                            <i class="fas fa-user text-pam-gray"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-pam-blue">Dr. Adebayo</h4>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <span class="text-pam-gray text-sm ml-2">2 weeks ago</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-pam-gray">Excellent quality medical supplies. Delivery was prompt and the packaging was secure. Will definitely order again.</p>
                </div>
                
                <!-- Review 2 -->
                <div class="border-b border-pam-gray-light pb-6">
                    <div class="flex items-center mb-2">
                        <div class="w-10 h-10 rounded-full bg-pam-gray-light flex items-center justify-center mr-3">
                            <i class="fas fa-user text-pam-gray"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-pam-blue">Nurse Chioma</h4>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-gray-300 text-sm"></i>
                                <span class="text-pam-gray text-sm ml-2">1 month ago</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-pam-gray">Good quality products, though one item was missing from my order. Customer service resolved it quickly though.</p>
                </div>
                
                <!-- Review Form (Visible when logged in) -->
                <div class="pt-4">
                    <h3 class="text-lg font-medium text-pam-blue mb-4">Write a Review</h3>
                    <form>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Rating</label>
                            <div class="flex">
                                <i class="far fa-star text-2xl text-yellow-400 cursor-pointer hover:text-yellow-500"></i>
                                <i class="far fa-star text-2xl text-yellow-400 cursor-pointer hover:text-yellow-500"></i>
                                <i class="far fa-star text-2xl text-yellow-400 cursor-pointer hover:text-yellow-500"></i>
                                <i class="far fa-star text-2xl text-yellow-400 cursor-pointer hover:text-yellow-500"></i>
                                <i class="far fa-star text-2xl text-yellow-400 cursor-pointer hover:text-yellow-500"></i>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="reviewText" class="block text-sm font-medium text-pam-gray mb-1">Review</label>
                            <textarea id="reviewText" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue" rows="3"></textarea>
                        </div>
                        <button type="submit" class="bg-pam-blue text-white py-2 px-4 rounded-md hover:bg-pam-blue-light transition">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-pam-blue mb-6">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Related Product 1 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="First Aid Kit" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <button class="like-btn bg-white rounded-full p-2 shadow-md hover:bg-pam-gray-light" aria-label="Like this item">
                                <i class="far fa-heart text-pam-gray"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-pam-blue mb-1">First Aid Kit</h3>
                        <p class="text-pam-gray text-sm mb-2">Basic emergency medical kit</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="font-bold text-pam-blue">₦8,500</span>
                            <a href="#" class="text-pam-blue-light hover:text-pam-blue text-sm font-medium">View Details →</a>
                        </div>
                    </div>
                </div>
                
                <!-- Related Product 2 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Surgical Masks" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <button class="like-btn bg-white rounded-full p-2 shadow-md hover:bg-pam-gray-light" aria-label="Like this item">
                                <i class="far fa-heart text-pam-gray"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-pam-blue mb-1">Surgical Masks</h3>
                        <p class="text-pam-gray text-sm mb-2">Pack of 50 medical masks</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="font-bold text-pam-blue">₦4,200</span>
                            <a href="#" class="text-pam-blue-light hover:text-pam-blue text-sm font-medium">View Details →</a>
                        </div>
                    </div>
                </div>
                
                <!-- Related Product 3 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1584634731339-252c58ab3a9f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Medical Gloves" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <button class="like-btn bg-white rounded-full p-2 shadow-md hover:bg-pam-gray-light" aria-label="Like this item">
                                <i class="far fa-heart text-pam-gray"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-pam-blue mb-1">Medical Gloves</h3>
                        <p class="text-pam-gray text-sm mb-2">Box of 100 latex-free gloves</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="font-bold text-pam-blue">₦6,800</span>
                            <a href="#" class="text-pam-blue-light hover:text-pam-blue text-sm font-medium">View Details →</a>
                        </div>
                    </div>
                </div>
                
                <!-- Related Product 4 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Digital Thermometer" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <button class="like-btn bg-white rounded-full p-2 shadow-md hover:bg-pam-gray-light" aria-label="Like this item">
                                <i class="far fa-heart text-pam-gray"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-pam-blue mb-1">Digital Thermometer</h3>
                        <p class="text-pam-gray text-sm mb-2">Fast and accurate readings</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="font-bold text-pam-blue">₦3,500</span>
                            <a href="#" class="text-pam-blue-light hover:text-pam-blue text-sm font-medium">View Details →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal (Hidden by default) -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg max-w-md w-full p-6 mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-pam-blue">Join Our Community</h3>
                <button id="closeModal" class="text-pam-gray hover:text-pam-blue" aria-label="Close modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <p class="text-pam-gray mb-6">Sign in to save items to your favorites and access other member benefits.</p>
            
            <form class="space-y-4">
                <div>
                    <label for="loginEmail" class="block text-sm font-medium text-pam-gray mb-1">Email</label>
                    <input type="email" id="loginEmail" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                </div>
                <div>
                    <label for="loginPassword" class="block text-sm font-medium text-pam-gray mb-1">Password</label>
                    <input type="password" id="loginPassword" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" class="h-4 w-4 text-pam-blue focus:ring-pam-blue border-pam-gray-light rounded">
                        <label for="remember" class="ml-2 block text-sm text-pam-gray">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-pam-blue hover:text-pam-blue-light">Forgot password?</a>
                </div>
                <button type="submit" class="w-full bg-pam-blue text-white py-2 px-4 rounded-md hover:bg-pam-blue-light transition">Sign In</button>
            </form>
            
            <div class="mt-4 text-center">
                <p class="text-sm text-pam-gray">Don't have an account? <a href="#" class="text-pam-blue hover:text-pam-blue-light font-medium">Register</a></p>
            </div>
            
            <div class="mt-6 pt-6 border-t border-pam-gray-light">
                <button id="continueAsGuest" class="w-full border border-pam-gray-light text-pam-gray py-2 px-4 rounded-md hover:bg-pam-gray-light transition">
                    Continue as Guest
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white mt-12 border-t border-pam-gray-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-pam-blue mb-4">PAM Logistics</h3>
                    <p class="text-pam-gray text-sm">Your trusted partner for medical equipment logistics and supply chain solutions across Nigeria.</p>
                    <div class="mt-4 flex items-center">
                        <i class="fas fa-phone-alt text-pam-gray mr-2"></i>
                        <span class="text-pam-gray text-sm">+234 800 123 4567</span>
                    </div>
                    <div class="mt-1 flex items-center">
                        <i class="fas fa-envelope text-pam-gray mr-2"></i>
                        <span class="text-pam-gray text-sm">info@pamlogistics.com</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-pam-blue mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-pam-gray hover:text-pam-blue text-sm">Home</a></li>
                        <li><a href="#" class="text-pam-gray hover:text-pam-blue text-sm">Inventory</a></li>
                        <li><a href="#" class="text-pam-gray hover:text-pam-blue text-sm">About Us</a></li>
                        <li><a href="#" class="text-pam-gray hover:text-pam-blue text-sm">Contact</a></li>
                        <li><a href="#" class="text-pam-gray hover:text-pam-blue text-sm">FAQs</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-pam-blue mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-pam-gray hover:text-pam-blue text-sm">Medical Equipment</a></li>
                        <li><a href="#" class="text-pam-gray hover:text-pam-blue text-sm">Pharmaceuticals</a></li>
                        <li><a href="#" class="text-pam-gray hover:text-pam-blue text-sm">Hospital Supplies</a></li>
                        <li><a href="#" class="text-pam-gray hover:text-pam-blue text-sm">Diagnostic Tools</a></li>
                        <li><a href="#" class="text-pam-gray hover:text-pam-blue text-sm">Consumables</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-pam-blue mb-4">Newsletter</h3>
                    <p class="text-pam-gray text-sm mb-3">Subscribe to our newsletter for updates on new products and special offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="flex-1 border border-pam-gray-light rounded-l-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue text-sm">
                        <button type="submit" class="bg-pam-blue text-white px-4 py-2 rounded-r-md hover:bg-pam-blue-light transition text-sm">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                    <div class="mt-4 flex space-x-4">
                        <a href="#" class="text-pam-gray hover:text-pam-blue" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-pam-gray hover:text-pam-blue" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-pam-gray hover:text-pam-blue" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-pam-gray hover:text-pam-blue" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-pam-gray-light text-center text-sm text-pam-gray">
                <p>© 2023 PAM Logistics. All rights reserved. <a href="#" class="text-pam-blue hover:text-pam-blue-light">Privacy Policy</a> | <a href="#" class="text-pam-blue hover:text-pam-blue-light">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <script>
        // Like button functionality for guests
        const likeButtons = document.querySelectorAll('#likeButton, #likeButton2, .like-btn');
        const loginModal = document.getElementById('loginModal');
        const closeModal = document.getElementById('closeModal');
        const continueAsGuest = document.getElementById('continueAsGuest');

        likeButtons.forEach(button => {
            button.addEventListener('click', () => {
                loginModal.classList.remove('hidden');
            });
        });

        closeModal.addEventListener('click', () => {
            loginModal.classList.add('hidden');
        });

        continueAsGuest.addEventListener('click', () => {
            loginModal.classList.add('hidden');
        });

        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            if (event.target === loginModal) {
                loginModal.classList.add('hidden');
            }
        });

        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.add('hidden'));
                
                // Add active class to clicked button
                button.classList.add('active');
                
                // Remove border-transparent and add border-pam-blue
                button.classList.remove('border-transparent');
                button.classList.add('border-pam-blue');
                
                // Show corresponding content
                tabContents[index].classList.remove('hidden');
                
                // For other buttons, add border-transparent and remove border-pam-blue
                tabButtons.forEach((btn, i) => {
                    if (i !== index) {
                        btn.classList.add('border-transparent');
                        btn.classList.remove('border-pam-blue');
                    }
                });
            });
        });

        // Image zoom effect
        const zoomContainer = document.querySelector('.image-zoom-container');
        const zoomImage = zoomContainer.querySelector('img');

        zoomContainer.addEventListener('mousemove', (e) => {
            const { left, top, width, height } = zoomContainer.getBoundingClientRect();
            const x = (e.clientX - left) / width;
            const y = (e.clientY - top) / height;
            zoomImage.style.transformOrigin = `${x * 100}% ${y * 100}%`;
        });

        zoomContainer.addEventListener('mouseleave', () => {
            zoomImage.style.transformOrigin = 'center center';
            zoomImage.style.transform = 'scale(1)';
        });
    </script>
</body>
</html>