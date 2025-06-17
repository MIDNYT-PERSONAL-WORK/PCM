<x-admin-nav>
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-pam-blue">Inventory Management</h2>
            <p class="text-pam-gray">Track and manage all warehouse inventory items</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button onclick="openAddInventoryModal()" class="bg-pam-blue hover:bg-pam-blue-light text-white px-4 py-2 rounded-lg flex items-center transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Inventory
            </button>
        </div>
    </div>

    <!-- Inventory Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Total Items</div>
            <div class="text-2xl font-bold text-pam-blue">1,842</div>
            <div class="text-xs text-pam-green flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                5% from last month
            </div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Low Stock</div>
            <div class="text-2xl font-bold text-pam-blue">47</div>
            <div class="text-xs text-pam-gray">Items below threshold</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Out of Stock</div>
            <div class="text-2xl font-bold text-pam-blue">12</div>
            <div class="text-xs text-pam-gray">Requires restocking</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Categories</div>
            <div class="text-2xl font-bold text-pam-blue">24</div>
            <div class="text-xs text-pam-gray">Product categories</div>
        </div>
    </div>

    <!-- Filter and Search Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
        <div class="flex items-center space-x-2">
            <button class="px-3 py-1 bg-pam-blue text-white rounded-lg text-sm">All</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Electronics</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Clothing</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Furniture</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Other</button>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <input type="text" placeholder="Search inventory..." class="w-full pl-10 pr-4 py-2 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                <div class="absolute left-3 top-2.5 text-pam-gray">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            <button class="p-2 border border-pam-gray-light rounded-lg hover:bg-pam-gray-light/50">
                <svg class="w-5 h-5 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Inventory Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-pam-gray-light">
            <thead class="bg-pam-gray-light">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Product</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">SKU</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Category</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Location</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Stock</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-pam-gray uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pam-gray-light">
                <!-- Item 1 -->
                <tr class="hover:bg-pam-gray-light/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-pam-gray-light rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-pam-blue">Wireless Headphones</div>
                                <div class="text-xs text-pam-gray">Model: WH-2023</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">SKU-WH-1001</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Electronics</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Aisle 3, Shelf B</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">142 units</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">Edit</button>
                        <button class="text-pam-green hover:text-green-700">Restock</button>
                    </td>
                </tr>

                <!-- Item 2 -->
                <tr class="hover:bg-pam-gray-light/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-pam-gray-light rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-pam-blue">Smartphone X</div>
                                <div class="text-xs text-pam-gray">Model: SPX-2023</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">SKU-SPX-2002</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Electronics</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Aisle 1, Shelf A</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">28 units</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Low Stock</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">Edit</button>
                        <button class="text-pam-green hover:text-green-700">Restock</button>
                    </td>
                </tr>

                <!-- Item 3 -->
                <tr class="hover:bg-pam-gray-light/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-pam-gray-light rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-pam-blue">Shipping Boxes</div>
                                <div class="text-xs text-pam-gray">Size: Large</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">SKU-BX-3003</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Packaging</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Aisle 5, Shelf C</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">0 units</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Out of Stock</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">Edit</button>
                        <button class="text-pam-green hover:text-green-700">Restock</button>
                    </td>
                </tr>

                <!-- Item 4 -->
                <tr class="hover:bg-pam-gray-light/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-pam-gray-light rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-pam-blue">Office Chair</div>
                                <div class="text-xs text-pam-gray">Model: OC-500</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">SKU-OC-4004</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Furniture</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">Aisle 8, Shelf D</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">15 units</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">Edit</button>
                        <button class="text-pam-green hover:text-green-700">Restock</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-pam-gray">
            Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">1,842</span> items
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50 disabled:opacity-50" disabled>
                Previous
            </button>
            <button class="px-3 py-1 border border-pam-blue-light bg-pam-blue-light text-white rounded-lg">
                1
            </button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50">
                2
            </button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50">
                3
            </button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50">
                Next
            </button>
        </div>
    </div>
</div>

<!-- Add Inventory Modal -->
<div id="addInventoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-pam-blue">Add New Inventory Item</h3>
                <button onclick="closeAddInventoryModal()" class="text-pam-gray hover:text-pam-blue">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="inventoryForm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Left Column -->
                    <div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Product Name*</label>
                            <input type="text" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">SKU*</label>
                            <input type="text" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Category*</label>
                            <select required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                                <option value="">Select Category</option>
                                <option>Electronics</option>
                                <option>Clothing</option>
                                <option>Furniture</option>
                                <option>Packaging</option>
                                <option>Other</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Initial Quantity*</label>
                            <input type="number" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Location*</label>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-xs text-pam-gray mb-1">Aisle</label>
                                    <input type="text" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-xs text-pam-gray mb-1">Shelf</label>
                                    <input type="text" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Reorder Threshold</label>
                            <input type="number" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition" placeholder="Leave blank for default">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Supplier</label>
                            <input type="text" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Product Image</label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col w-full h-32 border-2 border-dashed border-pam-gray-light hover:border-pam-blue-light hover:bg-pam-gray-light/20 rounded-lg cursor-pointer">
                                    <div class="flex flex-col items-center justify-center pt-7">
                                        <svg class="w-8 h-8 text-pam-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="pt-1 text-sm text-pam-gray">Upload product image</p>
                                    </div>
                                    <input type="file" class="opacity-0">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-pam-gray-light">
                    <button type="button" onclick="closeAddInventoryModal()" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-pam-green text-white rounded-lg hover:bg-green-600 transition">Add Inventory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Inventory modal functions
    function openAddInventoryModal() {
        document.getElementById('addInventoryModal').classList.remove('hidden');
    }

    function closeAddInventoryModal() {
        document.getElementById('addInventoryModal').classList.add('hidden');
    }

    // Form submission
    document.getElementById('inventoryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Here you would typically send the data to your backend
        alert('Inventory item added successfully!');
        closeAddInventoryModal();
        
        // In a real app, you would then refresh the inventory list or add the new item to the table
    });

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target === document.getElementById('addInventoryModal')) {
            closeAddInventoryModal();
        }
    });
</script>
</x-admin-nav>