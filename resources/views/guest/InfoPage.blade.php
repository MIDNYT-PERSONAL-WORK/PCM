<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | PAM Logistics</title>
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
        
        /* Cart Dropdown Styles */
        .cart-dropdown {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 100;
            overflow: hidden;
        }
        .cart-dropdown.active {
            display: block;
        }
        .cart-container {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            max-width: 450px;
            height: 100%;
            background: white;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
        }
        .cart-dropdown.active .cart-container {
            transform: translateX(0);
        }
        .cart-header {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }
        .cart-content {
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .cart-items {
            flex: 1;
            padding: 1rem;
        }
        .cart-footer {
            padding: 1rem;
            border-top: 1px solid #f3f4f6;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .thumbnail-container {
            scroll-behavior: smooth;
        }
        
        @media (min-width: 768px) {
            .cart-dropdown {
                position: absolute;
                top: 100%;
                right: 0;
                width: 450px;
                height: 80vh;
                max-height: 80vh;
                background: transparent;
            }
            .cart-container {
                position: relative;
                width: 100%;
                height: 100%;
                max-height: 80vh;
                border-radius: 0.5rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                transform: none;
            }
            .cart-dropdown.active .cart-container {
                transform: none;
            }
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
                        <span class="text-xl font-bold text-pam-blue">PAM Logistics</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <button id="cartButton" class="flex items-center text-pam-gray hover:text-pam-blue px-3 py-2 text-sm font-medium">
                            <i class="fas fa-shopping-cart mr-1"></i>
                            <span id="cartCount">0</span>
                        </button>
                        <div id="cartDropdown" class="cart-dropdown">
                            <div class="cart-container">
                                <div class="cart-header">
                                    <h3 class="text-lg font-semibold text-pam-blue">Your Cart</h3>
                                    <button id="closeCart" class="text-pam-gray hover:text-pam-red">
                                        <i class="fas fa-times text-xl"></i>
                                    </button>
                                </div>
                                <div class="cart-content">
                                    <div class="cart-items" id="cartItems">
                                        <p class="text-pam-gray text-center py-4">Your cart is empty</p>
                                    </div>
                                    <div class="cart-footer hidden" id="cartSummary">
                                        <div class="flex justify-between mb-2">
                                            <span class="text-pam-gray">Subtotal:</span>
                                            <span id="cartSubtotal" class="font-medium">GH₵0.00</span>
                                        </div>
                                        <div class="flex justify-between mb-2">
                                            <span class="text-pam-gray">Delivery:</span>
                                            <span id="cartDelivery" class="font-medium">GH₵0.00</span>
                                        </div>
                                        <div class="flex justify-between text-lg font-semibold text-pam-blue">
                                            <span>Total:</span>
                                            <span id="cartTotal">GH₵0.00</span>
                                        </div>
                                        
                                        <!-- Checkout Form -->
                                        <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST" class="mt-4">
                                            @csrf
                                            <input type="hidden" name="cart_items" id="cartItemsInput">
                                            <input type="hidden" name="subtotal" id="subtotalInput">
                                            <input type="hidden" name="delivery_cost" id="deliveryCostInput">
                                            <input type="hidden" name="total" id="totalInput">
                                            
                                            <div class="mb-4">
                                                <label for="customer_name" class="block text-sm font-medium text-pam-gray mb-1">Full Name</label>
                                                <input type="text" id="customer_name" name="customer_name" required 
                                                       class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                                            </div>
                                            
                                            <div class="mb-4">
                                                <label for="phone" class="block text-sm font-medium text-pam-gray mb-1">Phone Number</label>
                                                <input type="tel" id="phone" name="phone" required 
                                                       class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                                            </div>
                                            
                                            <div class="mb-4">
                                                <label for="location" class="block text-sm font-medium text-pam-gray mb-1">Delivery Address</label>
                                                <textarea id="location" name="location" required rows="3"
                                                          class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue"></textarea>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <label for="city" class="block text-sm font-medium text-pam-gray mb-1">City</label>
                                                <select id="city" name="city" required 
                                                        class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                                                    <option value="">Select your city</option>
                                                    <option value="Accra">Accra</option>
                                                    <option value="Kumasi">Kumasi</option>
                                                    <option value="Tamale">Tamale</option>
                                                    <option value="Takoradi">Takoradi</option>
                                                    <option value="Cape Coast">Cape Coast</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <label for="notes" class="block text-sm font-medium text-pam-gray mb-1">Order Notes (Optional)</label>
                                                <textarea id="notes" name="notes" rows="2"
                                                          class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue"></textarea>
                                            </div>
                                            
                                            <button type="submit" class="w-full bg-pam-blue text-white py-2 px-4 rounded-md hover:bg-pam-blue-light transition">
                                                Complete Order
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('LoginSignup')}}" class="bg-pam-blue text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-pam-blue-light transition">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <a href="{{ route('welcome') }}" class="inline-flex items-center text-pam-blue-light hover:text-pam-blue mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Back to Previous Page
        </a>
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

        <!-- Product Detail -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="md:flex">
                <!-- Product Images -->
                <div class="md:w-1/2 p-6">
                    <!-- Main Image Container -->
                    <div class="relative image-zoom-container mb-4">
                        <img id="mainProductImage" 
                            src="{{ json_decode($product->images)[0] ? asset('storage/'.json_decode($product->images)[0]) : 'https://via.placeholder.com/800' }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-96 object-contain rounded-lg bg-pam-gray-light">
                        <button id="likeButton" class="absolute top-4 right-4 bg-white rounded-full p-3 shadow-md hover:bg-pam-gray-light transition" aria-label="Like this item">
                            <i id="heartIcon" class="far fa-heart text-2xl text-pam-red"></i>
                        </button>
                    </div>

                    <!-- Thumbnail Gallery with Auto-Scroll -->
                    @if($product->images && count(json_decode($product->images)) > 0)
                    <div class="relative">
                        <div class="thumbnail-container flex space-x-2 overflow-x-auto pb-4 scrollbar-hide">
                            @foreach(json_decode($product->images) as $imagePath)
                            <div class="flex-shrink-0 relative group">
                                <img src="{{ asset('storage/'.$imagePath) }}" 
                                    alt="Thumbnail {{ $loop->iteration }}" 
                                    class="h-20 w-20 object-cover rounded cursor-pointer border-2 border-transparent group-hover:border-pam-blue transition-all duration-200"
                                    onclick="document.getElementById('mainProductImage').src = this.src">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-200 rounded"></div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Navigation Arrows (only show if multiple images) -->
                        @if(count(json_decode($product->images)) > 4)
                        <button class="thumbnail-prev absolute left-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow-md z-10 transform -translate-x-2 hover:scale-110 transition">
                            <i class="fas fa-chevron-left text-pam-blue"></i>
                        </button>
                        <button class="thumbnail-next absolute right-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow-md z-10 transform translate-x-2 hover:scale-110 transition">
                            <i class="fas fa-chevron-right text-pam-blue"></i>
                        </button>
                        @endif
                    </div>
                    @else
                    <div class="h-20 w-20 bg-pam-gray-light rounded flex items-center justify-center">
                        <span class="text-pam-gray text-sm">No images</span>
                    </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="md:w-1/2 p-6">
                    <div class="border-b border-pam-gray-light pb-4 mb-4">
                        <h1 class="text-2xl font-bold text-pam-blue mb-2">{{ $product->name }}</h1>
                        <div class="flex items-center mb-2">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($product->average_rating))
                                        <i class="fas fa-star text-yellow-400"></i>
                                    @elseif($i == ceil($product->average_rating) && $product->average_rating - floor($product->average_rating) >= 0.5)
                                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                                    @else
                                        <i class="far fa-star text-yellow-400"></i>
                                    @endif
                                @endfor
                                <span class="text-pam-gray ml-2">{{ $product->reviews_count }} reviews</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-pam-blue">GH₵{{ number_format($product->price, 2) }}</span>
                            <span class="bg-{{ $product->stock > 0 ? 'pam-green' : 'pam-red' }} text-white text-sm px-2 py-1 rounded-full">
                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>
                        @if($product->compare_price)
                        <div class="mt-1">
                            <span class="text-pam-gray line-through">GH₵{{ number_format($product->compare_price, 2) }}</span>
                            <span class="text-pam-green ml-2">{{ round(100 - ($product->price / $product->compare_price * 100)) }}% OFF</span>
                        </div>
                        @endif
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-pam-blue mb-2">Description</h3>
                        <p class="text-pam-gray">{{ $product->description }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-pam-blue mb-2">Details</h3>
                        <ul class="text-pam-gray space-y-1">
                            <li><span class="font-medium">SKU:</span> {{ $product->sku }}</li>
                            <li><span class="font-medium">Category:</span> {{ $product->category_id ?? 'N/A' }}</li>
                            <li><span class="font-medium">Weight:</span> {{ $product->weight }} kg</li>
                            <li><span class="font-medium">Vendor:</span> {{ $venderDetails->name  }}</li>
                            <li><span class="font-medium">Stock:</span> {{ $product->stock }} units available</li>
                        </ul>
                    </div>

                    <!-- Like and Share -->
                    <div class="flex items-center space-x-4 mb-6">
                        <button id="likeButton2" class="flex items-center text-pam-gray hover:text-pam-red" aria-label="Like this item">
                            <i id="heartIcon2" class="far fa-heart mr-1"></i>
                            <span id="likeCount2">Like</span>
                        </button>
                        <button class="flex items-center text-pam-gray hover:text-pam-blue" aria-label="Share this item">
                            <i class="fas fa-share-alt mr-1"></i>
                            <span>Share</span>
                        </button>
                    </div>

                    <!-- Delivery Calculator -->
                    <div class="bg-pam-gray-light p-4 rounded-lg mb-6">
                        <h3 class="text-lg font-semibold text-pam-blue mb-3">Quantity Selector</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                           
                        <div class="flex items-center">
                            <button id="decrementQuantity" class="bg-pam-gray-light px-3 py-1 rounded-l-md border border-pam-gray-light hover:bg-pam-gray">-</button>
                            <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-16 text-center border-t border-b border-pam-gray-light py-1">
                            <button id="incrementQuantity" class="bg-pam-gray-light px-3 py-1 rounded-r-md border border-pam-gray-light hover:bg-pam-gray">+</button>
                        </div>
                        </div>
                        <div id="deliveryCost" class="mt-3 text-pam-blue font-semibold text-lg hidden">
                            Delivery Cost: <span id="costValue">GH₵ 0</span>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                        @if($venderDetails)
                            <a 
                                href="tel:{{ $venderDetails->phone }}" 
                                class="flex-1 bg-pam-blue text-white py-3 px-4 rounded-md hover:bg-pam-blue-dark transition font-medium text-center"
                            >
                                <i class="fas fa-phone-alt mr-2"></i> Call Vendor
                            </a>
                        @endif
                        <button id="addToCartBtn" class="flex-1 border border-pam-blue text-pam-blue py-3 px-4 rounded-md hover:bg-pam-gray-light transition font-medium">
                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        </button>
                        <button id="checkoutBtn" class="flex-1 bg-pam-green text-white py-3 px-4 rounded-md hover:bg-pam-green-dark transition font-medium hidden">
                            <i class="fas fa-credit-card mr-2"></i> Checkout Now
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
                                @if($product->specifications && is_array($product->specifications->contents))
                                    @foreach($product->specifications->contents as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                @else
                                    <li>No contents specified</li>
                                @endif
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-medium text-pam-blue mb-2">Certifications</h4>
                            <ul class="list-disc list-inside text-pam-gray space-y-1">
                                @if($product->specifications && is_array($product->specifications->certifications))
                                    @foreach($product->specifications->certifications as $cert)
                                        <li>{{ $cert }}</li>
                                    @endforeach
                                @else
                                    <li>No certifications specified</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content hidden">
                    <!-- Features content would go here -->
                    @if($product->features)
                        {!! $product->features !!}
                    @else
                        <p class="text-pam-gray">No features information available.</p>
                    @endif
                </div>
                <div class="tab-content hidden">
                    <!-- Documentation content would go here -->
                    @if($product->documentation)
                        {!! $product->documentation !!}
                    @else
                        <p class="text-pam-gray">No documentation available.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-8 bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-pam-blue mb-6">Customer Reviews</h2>
            
            @if($product->reviews && $product->reviews->count() > 0)
                <div class="space-y-6">
                    @foreach($product->reviews as $review)
                    <div class="border-b border-pam-gray-light pb-6">
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 rounded-full bg-pam-gray-light flex items-center justify-center mr-3">
                                <i class="fas fa-user text-pam-gray"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-pam-blue">{{ $review->user->name ?? 'Anonymous' }}</h4>
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        @else
                                            <i class="far fa-star text-yellow-400 text-sm"></i>
                                        @endif
                                    @endfor
                                    <span class="text-pam-gray text-sm ml-2">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-pam-gray">{{ $review->comment }}</p>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-pam-gray">No reviews yet. Be the first to review this product!</p>
            @endif
            
            <!-- Review Form (Visible when logged in) -->
            <div class="pt-4">
                <h3 class="text-lg font-medium text-pam-blue mb-4">Write a Review</h3>
                <form action="" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-pam-gray mb-1">Rating</label>
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="far fa-star text-2xl text-yellow-400 cursor-pointer hover:text-yellow-500 rating-star" data-rating="{{ $i }}"></i>
                            @endfor
                            <input type="hidden" name="rating" id="ratingValue" value="0">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="reviewText" class="block text-sm font-medium text-pam-gray mb-1">Review</label>
                        <textarea id="reviewText" name="comment" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="bg-pam-blue text-white py-2 px-4 rounded-md hover:bg-pam-blue-light transition">Submit Review</button>
                </form>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-pam-blue mb-6">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                    <div class="relative">
                        <img src="{{ $relatedProduct->image_url ? Storage::url($relatedProduct->image_url) : 'https://via.placeholder.com/500' }}" alt="{{ $relatedProduct->name }}" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2">
                            <button class="like-btn bg-white rounded-full p-2 shadow-md hover:bg-pam-gray-light" aria-label="Like this item">
                                <i class="far fa-heart text-pam-gray"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-pam-blue mb-1">{{ $relatedProduct->name }}</h3>
                        <p class="text-pam-gray text-sm mb-2">{{ Str::limit($relatedProduct->description, 50) }}</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="font-bold text-pam-blue">₦{{ number_format($relatedProduct->price, 2) }}</span>
                            <a href="{{ route('products.show', $relatedProduct->id) }}" class="text-pam-blue-light hover:text-pam-blue text-sm font-medium">View Details →</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
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
                <p>© {{ date('Y') }} PAM Logistics. All rights reserved. <a href="#" class="text-pam-blue hover:text-pam-blue-light">Privacy Policy</a> | <a href="#" class="text-pam-blue hover:text-pam-blue-light">Terms of Service</a></p>
            </div>
        </div>
    </footer>

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

   <script>
    // Check for clear_cart flag when page loads
    @if(session()->has('success') || session()->has('error'))
        console.log('Session data:', {
            success: @json(session('success')),
            error: @json(session('error')),
            clear_cart: @json(session('clear_cart'))
        });
        
        // Clear localStorage if clear_cart is true
        @if(session('clear_cart'))
            localStorage.removeItem('cart');
            console.log('LocalStorage cart cleared');
        @endif
    @endif

    // Shopping Cart System
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartButton = document.getElementById('cartButton');
    const cartDropdown = document.getElementById('cartDropdown');
    const cartCount = document.getElementById('cartCount');
    const cartItems = document.getElementById('cartItems');
    const cartSubtotal = document.getElementById('cartSubtotal');
    const cartDelivery = document.getElementById('cartDelivery');
    const cartTotal = document.getElementById('cartTotal');
    const cartSummary = document.getElementById('cartSummary');
    const closeCart = document.getElementById('closeCart');
    const checkoutBtn = document.getElementById('checkoutBtn');
    
    // Delivery Calculator
    const fromLocation = document.getElementById('fromLocation');
    const toLocation = document.getElementById('toLocation');
    const deliveryCostDiv = document.getElementById('deliveryCost');
    const costValue = document.getElementById('costValue');
    
    // Define delivery cost rules
    const costMatrix = {
        'Lagos': { 'Lagos': 500, 'Abuja': 2000, 'Port Harcourt': 1500, 'Kano': 2500 },
        'Abuja': { 'Lagos': 2000, 'Abuja': 500, 'Port Harcourt': 1800, 'Kano': 1200 },
        'Port Harcourt': { 'Lagos': 1500, 'Abuja': 1800, 'Port Harcourt': 500, 'Kano': 2200 },
        'Kano': { 'Lagos': 2500, 'Abuja': 1200, 'Port Harcourt': 2200, 'Kano': 500 }
    };
    
    // Quantity Selector
    const quantityInput = document.getElementById('quantity');
    const decrementBtn = document.getElementById('decrementQuantity');
    const incrementBtn = document.getElementById('incrementQuantity');
    
    // Product Details
    const product = @json($product);
    
    // Update cart count
    function updateCartCount() {
        const count = cart.reduce((total, item) => total + item.quantity, 0);
        cartCount.textContent = count;
        
        // Show/hide checkout button based on cart items
        if (count > 0) {
            checkoutBtn.classList.remove('hidden');
        } else {
            checkoutBtn.classList.add('hidden');
        }
    }
    
    // Update cart display
    function updateCartDisplay() {
        if (cart.length === 0) {
            cartItems.innerHTML = '<p class="text-pam-gray text-center py-4">Your cart is empty</p>';
            cartSummary.classList.add('hidden');
            return;
        }
        
        let itemsHTML = '';
        let subtotal = 0;
        
        cart.forEach(item => {
            subtotal += item.price * item.quantity;
            itemsHTML += `
                <div class="flex items-center py-3 border-b border-pam-gray-light">
                    <img src="${item.image}" alt="${item.name}" class="w-12 h-12 object-cover rounded">
                    <div class="ml-3 flex-1">
                        <h4 class="text-sm font-medium text-pam-blue">${item.name}</h4>
                        <p class="text-xs text-pam-gray">${item.quantity} × GH₵${item.price.toLocaleString()}</p>
                    </div>
                    <div class="flex items-center">
                        <button class="decrease-quantity text-pam-gray hover:text-pam-blue px-2" data-id="${item.id}">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span class="mx-1 text-sm">${item.quantity}</span>
                        <button class="increase-quantity text-pam-gray hover:text-pam-blue px-2" data-id="${item.id}">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="remove-from-cart text-pam-red hover:text-pam-red-dark ml-2" data-id="${item.id}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
        });
        
        cartItems.innerHTML = itemsHTML;
        cartSubtotal.textContent = `GH₵${subtotal.toLocaleString()}`;
        
        // Calculate delivery cost
        const from = fromLocation?.value;
        const to = toLocation?.value;
        let deliveryCost = 0;
        
        if (from && to && costMatrix[from] && costMatrix[from][to]) {
            deliveryCost = costMatrix[from][to];
        }
        
        cartDelivery.textContent = `GH₵${deliveryCost.toLocaleString()}`;
        cartTotal.textContent = `GH₵${(subtotal + deliveryCost).toLocaleString()}`;
        cartSummary.classList.remove('hidden');
        
        // Update hidden form inputs
        document.getElementById('cartItemsInput').value = JSON.stringify(cart);
        document.getElementById('subtotalInput').value = subtotal;
        document.getElementById('deliveryCostInput').value = deliveryCost;
        document.getElementById('totalInput').value = subtotal + deliveryCost;
        
        // Add event listeners to cart buttons
        document.querySelectorAll('.remove-from-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                removeFromCart(productId);
            });
        });
        
        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                decreaseQuantity(productId);
            });
        });
        
        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                increaseQuantity(productId);
            });
        });
    }
    
    // Add to cart
    function addToCart(product, quantity) {
        const existingItem = cart.find(item => item.id === product.id);
        
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            cart.push({
                id: product.id,
                name: product.name,
                price: product.price,
                image: product.image_url ? product.image_url : 'https://via.placeholder.com/500',
                quantity: quantity
            });
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        updateCartDisplay();
        cartDropdown.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    // Remove from cart
    function removeFromCart(productId) {
        cart = cart.filter(item => item.id !== productId);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        updateCartDisplay();
    }
    
    // Decrease quantity
    function decreaseQuantity(productId) {
        const item = cart.find(item => item.id === productId);
        if (item) {
            if (item.quantity > 1) {
                item.quantity -= 1;
            } else {
                // Remove if quantity would go to 0
                cart = cart.filter(item => item.id !== productId);
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            updateCartDisplay();
        }
    }
    
    // Increase quantity
    function increaseQuantity(productId) {
        const item = cart.find(item => item.id === productId);
        if (item) {
            item.quantity += 1;
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            updateCartDisplay();
        }
    }
    
    // Toggle cart dropdown
    cartButton.addEventListener('click', (e) => {
        e.stopPropagation();
        cartDropdown.classList.toggle('active');
        document.body.style.overflow = cartDropdown.classList.contains('active') ? 'hidden' : '';
    });
    
    // Close cart dropdown
    closeCart.addEventListener('click', () => {
        cartDropdown.classList.remove('active');
        document.body.style.overflow = '';
    });
    
    // Checkout button click handler
    checkoutBtn.addEventListener('click', () => {
        cartDropdown.classList.add('active');
        document.body.style.overflow = 'hidden';
    });
    
    // Close cart when clicking outside
    document.addEventListener('click', (e) => {
        if (!cartDropdown.contains(e.target) && e.target !== cartButton && e.target !== checkoutBtn) {
            cartDropdown.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
    
    // Calculate delivery cost
    function calculateDelivery() {
        const from = fromLocation?.value;
        const to = toLocation?.value;
        
        if (from && to && costMatrix[from] && costMatrix[from][to]) {
            const cost = costMatrix[from][to];
            costValue.textContent = `GH₵${cost.toLocaleString()}`;
            deliveryCostDiv.classList.remove('hidden');
        } else {
            deliveryCostDiv.classList.add('hidden');
        }
        
        // Update cart display to reflect new delivery cost
        updateCartDisplay();
    }
    
    // Delivery calculator event listeners
    if (fromLocation && toLocation) {
        fromLocation.addEventListener('change', calculateDelivery);
        toLocation.addEventListener('change', calculateDelivery);
    }
    
    // Quantity selector
    decrementBtn.addEventListener('click', () => {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
        }
    });
    
    incrementBtn.addEventListener('click', () => {
        let value = parseInt(quantityInput.value);
        if (value < product.stock) {
            quantityInput.value = value + 1;
        }
    });
    
    // Add to cart button
    document.getElementById('addToCartBtn').addEventListener('click', () => {
        const quantity = parseInt(quantityInput.value);
        addToCart(product, quantity);
        
        // Show success message
        alert(`${quantity} ${product.name} added to cart!`);
    });
    
    // Initialize cart
    updateCartCount();
    updateCartDisplay();
    
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
    if (zoomContainer) {
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
    }
    
    // Rating stars functionality
    const ratingStars = document.querySelectorAll('.rating-star');
    const ratingValue = document.getElementById('ratingValue');
    
    ratingStars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = parseInt(star.getAttribute('data-rating'));
            ratingValue.value = rating;
            
            // Update star display
            ratingStars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.remove('far');
                    s.classList.add('fas');
                } else {
                    s.classList.remove('fas');
                    s.classList.add('far');
                }
            });
        });
    });
    
    // Thumbnail navigation
    document.addEventListener('DOMContentLoaded', function() {
        const thumbnailContainer = document.querySelector('.thumbnail-container');
        const thumbnails = document.querySelectorAll('.thumbnail-container img');
        const prevBtn = document.querySelector('.thumbnail-prev');
        const nextBtn = document.querySelector('.thumbnail-next');
        
        if (thumbnails.length > 0) {
            // Set first thumbnail as active initially
            thumbnails[0].classList.add('border-pam-blue');
            
            // Click handler for thumbnails
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    thumbnails.forEach(t => t.classList.remove('border-pam-blue'));
                    this.classList.add('border-pam-blue');
                });
            });
            
            // Navigation arrows functionality
            if (prevBtn && nextBtn) {
                prevBtn.addEventListener('click', () => {
                    thumbnailContainer.scrollBy({ left: -100, behavior: 'smooth' });
                });
                
                nextBtn.addEventListener('click', () => {
                    thumbnailContainer.scrollBy({ left: 100, behavior: 'smooth' });
                });
            }
            
            // Auto-scroll if more than 4 thumbnails
            if (thumbnails.length > 4) {
                let scrollPosition = 0;
                const scrollStep = 100;
                const scrollInterval = setInterval(() => {
                    scrollPosition += scrollStep;
                    if (scrollPosition >= thumbnailContainer.scrollWidth - thumbnailContainer.clientWidth) {
                        scrollPosition = 0;
                    }
                    thumbnailContainer.scrollTo({
                        left: scrollPosition,
                        behavior: 'smooth'
                    });
                }, 3000);
                
                // Pause auto-scroll on hover
                thumbnailContainer.addEventListener('mouseenter', () => clearInterval(scrollInterval));
            }
        }
    });
</script>
</body>
</html>