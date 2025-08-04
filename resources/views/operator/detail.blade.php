<x-operator-nav>
    <body class="font-sans bg-pam-gray-light">
        <div class="flex h-screen">
            <!-- Main Content -->
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
                <div class="flex-1 overflow-y-auto p-4 md:p-6">
                    <!-- Order Header -->
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light mb-6">
                        <div class="flex flex-col md:flex-row md:justify-between">
                            <div class="mb-4 md:mb-0">
                                <h2 class="text-lg font-semibold text-pam-blue">DRAFT ORDER</h2>
                                <div class="flex items-center mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pam-yellow-100 text-pam-yellow-800">
                                        {{ ucfirst($draft->status) }}
                                    </span>
                                    <span class="ml-2 text-sm text-pam-gray">Created: {{ $draft->created_at->format('M j, Y g:i a') }}</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 md:flex md:space-x-6">
                                <div>
                                    <p class="text-sm font-medium text-pam-gray">Order #</p>
                                    <p class="text-base font-semibold text-pam-blue">DRAFT-{{ $draft->id }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-pam-gray">Vendor</p>
                                    <p class="text-base font-semibold text-pam-blue">
                                        @if($draft->items->isNotEmpty() && $draft->items->first()->product->vendor)
                                            {{ $draft->items->first()->product->vendor->name }}
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-pam-gray">Priority</p>
                                    <p class="text-base font-semibold text-pam-blue">Standard</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Two Column Layout -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Left Column - Customer Info -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Customer Information -->
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-medium text-pam-gray">Customer Information</h3>
                                    <button class="text-sm text-pam-blue-light hover:text-pam-blue">Edit</button>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-pam-gray">Name</label>
                                        <p class="mt-1 text-sm text-pam-blue font-medium">{{ $draft->customer_name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-pam-gray">Phone</label>
                                        <p class="mt-1 text-sm text-pam-blue font-medium">{{ $draft->phone }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-pam-gray">Delivery Address</label>
                                        <p class="mt-1 text-sm text-pam-blue font-medium whitespace-pre-line">{{ $draft->location }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-pam-gray">City</label>
                                        <p class="mt-1 text-sm text-pam-blue font-medium">{{ $draft->city }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-pam-gray">Special Instructions</label>
                                        <p class="mt-1 text-sm text-pam-blue font-medium">{{ $draft->notes ?? 'None' }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Order Items -->
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-medium text-pam-gray">Order Items</h3>
                                    <button class="text-sm text-pam-blue-light hover:text-pam-blue">Add Item</button>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-pam-gray-light">
                                        <thead class="bg-pam-gray-light">
                                            <tr>
                                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">#</th>
                                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Item</th>
                                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Qty</th>
                                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Price</th>
                                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Total</th>
                                                <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-pam-gray-light">
                                            @foreach($draft->items as $item)
                                            <tr>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-pam-gray">{{ $loop->iteration }}</td>
                                                <td class="px-3 py-4 text-sm text-pam-blue font-medium">
                                                    {{ $item->product->name }}
                                                    <div class="text-xs text-pam-gray mt-1">SKU: {{ $item->product->sku }}</div>
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-pam-gray">{{ $item->quantity }}</td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-pam-gray">GHC {{ number_format($item->price, 2) }}</td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-pam-gray">GHC {{ number_format($item->amount, 2) }}</td>
                                                <td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <button class="text-pam-blue-light hover:text-pam-blue">Edit</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="bg-pam-gray-light">
                                            @php
                                                $subtotal = $draft->items->sum('amount');
                                                $deliveryFee = $draft->items->first()->delivery_fee ?? 0.00;
                                                $tax = $subtotal * 0.00;
                                                $total = $subtotal + $deliveryFee + $tax;
                                            @endphp
                                            <tr>
                                                <td colspan="4" class="px-3 py-4 text-right text-sm font-medium text-pam-gray">Subtotal</td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-pam-gray">GHC {{ number_format($subtotal, 2) }}</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="px-3 py-4 text-right text-sm font-medium text-pam-gray">
                                                    Delivery Fee
                                                    <form method="POST" action="{{ route('draft.setDeliveryFee', $draft->id) }}" class="inline ml-2">
                                                        @csrf
                                                        <input type="number" 
                                                               name="delivery_fee" 
                                                               value="{{ number_format($deliveryFee, 2) }}" 
                                                               min="0" 
                                                               step="0.50"
                                                               class="w-20 p-1 border border-pam-gray-light rounded"
                                                               onchange="this.form.submit()">
                                                    </form>
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-pam-gray">GHC {{ number_format($deliveryFee, 2) }}</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="px-3 py-4 text-right text-sm font-medium text-pam-gray">Tax</td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-pam-gray">GHC {{ number_format($tax, 2) }}</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="px-3 py-4 text-right text-sm font-medium text-pam-blue">Total</td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm font-semibold text-pam-blue">GHC {{ number_format($total, 2) }}</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Internal Notes -->
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                                <h3 class="text-lg font-medium text-pam-gray mb-4">Internal Notes</h3>
                                <textarea rows="3" class="block w-full rounded-md border border-pam-gray-light shadow-sm focus:border-pam-blue-light focus:ring focus:ring-pam-blue-light focus:ring-opacity-50 p-2 text-sm" placeholder="Add any internal notes about this order...">{{ $draft->notes ?? '' }}</textarea>
                                <div class="mt-2 flex justify-end">
                                    <button class="px-3 py-1 bg-pam-blue-light text-white text-sm rounded hover:bg-pam-blue">Save Note</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column - Order Summary & Actions -->
                        <div class="space-y-6">
                            <!-- Order Summary -->
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                                <h3 class="text-lg font-medium text-pam-gray mb-4">Order Summary</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-pam-gray">Status</label>
                                        <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-pam-gray-light focus:outline-none focus:ring-pam-blue-light focus:border-pam-blue-light sm:text-sm rounded-md bg-pam-yellow-50 border-pam-yellow-100 text-pam-yellow-800">
                                            @foreach(['draft', 'pending_call', 'processing', 'completed', 'cancelled'] as $status)
                                                <option value="{{ $status }}" {{ $draft->status == $status ? 'selected' : '' }}>
                                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-pam-gray">Payment Method</label>
                                        <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-pam-gray-light focus:outline-none focus:ring-pam-blue-light focus:border-pam-blue-light sm:text-sm rounded-md">
                                            <option>Cash on Delivery</option>
                                            <option>Momo</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-pam-gray">Payment Status</label>
                                        <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-pam-gray-light focus:outline-none focus:ring-pam-blue-light focus:border-pam-blue-light sm:text-sm rounded-md">
                                            <option>Pending</option>
                                            <option>Paid</option>
                                            <option>Partially Paid</option>
                                            <option>Refunded</option>
                                            <option>Failed</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-pam-gray">Delivery Time</label>
                                        <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-pam-gray-light focus:outline-none focus:ring-pam-blue-light focus:border-pam-blue-light sm:text-sm rounded-md">
                                            <option>ASAP</option>
                                            <option>Today, 12:00-14:00</option>
                                            <option>Today, 14:00-16:00</option>
                                            <option>Today, 16:00-18:00</option>
                                            <option>Today, 18:00-20:00</option>
                                            <option>Tomorrow Morning</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Rider Assignment -->
                                    <form method="POST" action="{{ route('draft.assignRider', $draft->id) }}">
                                        @csrf
                                        <label class="block text-sm font-medium text-pam-gray">Assign Rider</label>
                                        <select name="rider_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-pam-gray-light focus:outline-none focus:ring-pam-blue-light focus:border-pam-blue-light sm:text-sm rounded-md">
                                            <option value="">-- Select Rider --</option>
                                            @foreach($riders as $rider)
                                                <option value="{{ $rider->id }}" {{ $draft->rider_id == $rider->id ? 'selected' : '' }}>
                                                    {{ $rider->name }} 
                                                    @if($rider->is_active)
                                                        (Active)-({{ $rider->phone }})
                                                    @else
                                                        (Inactive)-({{ $rider->phone }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="mt-2 bg-pam-blue text-white px-3 py-1 rounded">Assign Rider</button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Rider Information -->
                           @if($draft->rider)
                            <div class="bg-white p-3 sm:p-4 rounded-lg shadow-sm border border-pam-gray-light">
                                <h3 class="text-base sm:text-lg font-medium text-pam-gray mb-3 sm:mb-4">Rider Information</h3>
                                <div class="flex flex-col sm:flex-row sm:items-start gap-3 sm:gap-4">
                                    <div class="flex items-center sm:items-start gap-3 sm:flex-col sm:gap-2 sm:flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-pam-blue-light flex items-center justify-center text-white font-medium">
                                            {{ substr($draft->rider->name, 0, 1) }}
                                        </div>
                                        <div class="sm:text-center">
                                            <h4 class="text-sm font-medium text-pam-blue">{{ $draft->rider->name }}</h4>
                                            <p class="text-xs text-pam-gray mt-1">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                                    @if($draft->rider->is_active) bg-green-100 text-green-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    @if($draft->rider->is_active)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <div class="grid grid-cols-1 xs:grid-cols-2 gap-2 text-xs">
                                            <div>
                                                <p class="text-pam-gray">Phone</p>
                                                <p class="text-pam-blue">{{ $draft->rider->phone ?? 'N/A' }}</p>
                                            </div>
                                            <div>
                                                <p class="text-pam-gray">Email</p>
                                                <p class="text-pam-blue break-all">{{ $draft->rider->email }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @if($draft->rider->phone)
                                            <a href="tel:{{ $draft->rider->phone }}" class="text-xs text-pam-blue-light hover:text-pam-blue flex items-center">
                                                <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                                Call
                                            </a>
                                            <a href="sms:{{ $draft->rider->phone }}" class="text-xs text-pam-blue-light hover:text-pam-blue flex items-center">
                                                <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                </svg>
                                                Message
                                            </a>
                                            @endif
                                            <button class="text-xs text-pam-blue-light hover:text-pam-blue flex items-center">
                                                <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                                </svg>
                                                Track
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Order Actions -->
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                                <h3 class="text-lg font-medium text-pam-gray mb-4">Order Actions</h3>
                                <div class="space-y-3">
                                    <!-- Confirm Order Form -->
                                    <form method="POST" action="{{ route('draft.confirm', $draft->id) }}" class="w-full">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="rider_id" value="{{ $draft->rider_id }}">
                                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pam-blue hover:bg-pam-blue-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue-light">
                                            Confirm Order
                                        </button>
                                    </form>

                                    <!-- Save as Draft Form -->
                                    <form method="POST" action="{{ route('draft.save', $draft->id) }}" class="w-full">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-blue bg-white hover:bg-pam-gray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue-light">
                                            Save as Draft
                                        </button>
                                    </form>

                                    <!-- Cancel Order Form -->
                                    <form method="POST" action="{{ route('draft.cancel', $draft->id) }}" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-red bg-white hover:bg-pam-gray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-red">
                                            Cancel Order
                                        </button>
                                    </form>

                                    <!-- Regular Buttons -->
                                    <button class="w-full flex justify-center py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-gray bg-white hover:bg-pam-gray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-gray">
                                        Notify Customer
                                    </button>
                                    
                                    <button class="w-full flex justify-center py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-gray bg-white hover:bg-pam-gray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-gray">
                                        Print Receipt
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Customer Communication -->
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-pam-gray-light">
                                <h3 class="text-lg font-medium text-pam-gray mb-4">Customer Communication</h3>
                                <div class="space-y-3">
                                    <button class="w-full flex justify-center py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-blue bg-white hover:bg-pam-gray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue-light">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Send Email
                                    </button>
                                    <button class="w-full flex justify-center py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-blue bg-white hover:bg-pam-gray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue-light">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Call Customer
                                    </button>
                                    <button class="w-full flex justify-center py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-blue bg-white hover:bg-pam-gray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue-light">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        Send SMS
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        // Auto-submit the delivery fee form when value changes
        document.querySelectorAll('input[name="delivery_fee"]').forEach(input => {
            input.addEventListener('change', function() {
                this.form.submit();
            });
        });
    </script>
</x-operator-nav>