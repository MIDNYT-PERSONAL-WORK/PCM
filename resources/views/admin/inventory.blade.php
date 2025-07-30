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
            <div class="text-2xl font-bold text-pam-blue">{{ $TotalItems }}</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Low Stock</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $LowStock }}</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Out of Stock</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $BelowThreshold }}</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Categories</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $Categories }}</div>
        </div>
    </div>

    <!-- Filter and Search Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
        <div class="flex items-center space-x-2">
            <button class="px-3 py-1 bg-pam-blue text-white rounded-lg text-sm">All</button>
            {{-- @foreach($categories as $category)
                <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">{{ $category->name }}</button>
            @endforeach --}}
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Price</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Stock</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-pam-gray uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pam-gray-light">
                @foreach($inventoryItems as $item)
                <tr class="hover:bg-pam-gray-light/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-pam-gray-light rounded-lg flex items-center justify-center">
                                @if($item->product->image_url)
                                    <img src="{{ Storage::url($item->product->image_url) }}" class="h-full w-full object-cover rounded-lg">
                                @else
                                    <!-- Default icon based on category -->
                                    {{-- @include('partials.product-icon', ['category' => $item->product->category->name]) --}}
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-pam-blue">{{ $item->product->name }}</div>
                                <div class="text-xs text-pam-gray">Model: {{ $item->product->model_number ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">{{ $item->product->sku }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">{{ $item->product->category_id }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">GHC{{ $item->product->price ?? 'Not specified' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">{{ $item->quantity_available }} units</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->quantity_available <= 0)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Out of Stock</span>
                        @elseif($item->quantity_available < 3)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Low Stock</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button onclick="openEditInventoryModal({{ $item->id }})" class="text-pam-blue-light hover:text-pam-blue mr-3">Edit</button>
                        <button onclick="confirmDeleteInventory({{ $item->id }})" class="text-red-500 hover:text-red-700">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $inventoryItems->links() }}
    </div>
</div>

<!-- Add/Edit Inventory Modal -->
<div id="inventoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-pam-blue" id="inventoryModalTitle">Add New Inventory Item</h3>
                <button onclick="closeInventoryModal()" class="text-pam-gray hover:text-pam-blue">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="inventoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="inventoryId" name="id">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Left Column -->
                    <div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Product*</label>
                            <select id="productId" name="product_id" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})</option>
                                @endforeach 
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Quantity*</label>
                            <input type="number" id="quantity" name="quantity_available" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Reorder Threshold</label>
                            <input type="number" id="reorderThreshold" name="reorder_threshold" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Location*</label>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-xs text-pam-gray mb-1">Aisle</label>
                                    <input type="text" id="aisle" name="aisle" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-xs text-pam-gray mb-1">Shelf</label>
                                    <input type="text" id="shelf" name="shelf" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Supplier</label>
                            <input type="text" id="supplier" name="supplier" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-1">Notes</label>
                            <textarea id="notes" name="notes" rows="2" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-pam-gray-light">
                    <button type="button" onclick="closeInventoryModal()" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-pam-green text-white rounded-lg hover:bg-green-600 transition">Save Inventory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-pam-blue">Confirm Deletion</h3>
                <button onclick="closeDeleteModal()" class="text-pam-gray hover:text-pam-blue">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <p class="text-pam-gray mb-6">Are you sure you want to delete this inventory item? This action cannot be undone.</p>
            
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Current inventory item being deleted
    let inventoryToDelete = null;

    // Modal functions
    function openAddInventoryModal() {
        document.getElementById('inventoryModalTitle').textContent = 'Add New Inventory Item';
        document.getElementById('inventoryForm').reset();
        document.getElementById('inventoryForm').action = "{{ route('inventory.store') }}";
        document.getElementById('inventoryId').value = '';
        document.getElementById('inventoryModal').classList.remove('hidden');
    }

    function openEditInventoryModal(inventoryId) {
        // Fetch inventory data via AJAX
        fetch(`/inventory/${inventoryId}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('inventoryModalTitle').textContent = 'Edit Inventory Item';
                document.getElementById('inventoryForm').action = `/inventory/${inventoryId}`;
                document.getElementById('inventoryForm').innerHTML += '<input type="hidden" name="_method" value="PUT">';
                
                document.getElementById('inventoryId').value = data.id;
                document.getElementById('productId').value = data.product_id;
                document.getElementById('quantity').value = data.quantity_available;
                document.getElementById('reorderThreshold').value = data.reorder_threshold;
                document.getElementById('aisle').value = data.aisle;
                document.getElementById('shelf').value = data.shelf;
                document.getElementById('supplier').value = data.supplier;
                document.getElementById('notes').value = data.notes;
                
                document.getElementById('inventoryModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error loading inventory data');
            });
    }

    function closeInventoryModal() {
        document.getElementById('inventoryModal').classList.add('hidden');
    }

    function confirmDeleteInventory(inventoryId) {
        inventoryToDelete = inventoryId;
        document.getElementById('deleteForm').action = `/inventory/${inventoryId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        inventoryToDelete = null;
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Form submission
    document.getElementById('inventoryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Here you would typically send the form data to your backend
        const formData = new FormData(this);
        const url = this.action;
        const method = this.querySelector('input[name="_method"]') ? this.querySelector('input[name="_method"]').value : 'POST';
        
        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error saving inventory');
        });
    });

    // Delete form submission
    document.getElementById('deleteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(this.action, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting inventory');
        });
    });

    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target === document.getElementById('inventoryModal')) {
            closeInventoryModal();
        }
        if (event.target === document.getElementById('deleteModal')) {
            closeDeleteModal();
        }
    });
</script>
</x-admin-nav>