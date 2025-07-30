<x-vendor-nav>
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Page Header -->
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

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-pam-blue">Product Management</h2>
            <p class="text-pam-gray">Manage your product catalog</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button onclick="openAddProductModal()" class="bg-pam-blue hover:bg-pam-blue-light text-white px-4 py-2 rounded-lg flex items-center transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Product
            </button>
        </div>
    </div>

    <!-- Product Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Total Products</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $TotalProducts->count() }}</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Active</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $TotalAvailableProducts }}</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Out of Stock</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $TotalOutStockProducts }}</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Drafts</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $TotalDraftProducts }}</div>
        </div>
    </div>

    <!-- Filter and Search Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
        <div class="flex items-center overflow-x-auto space-x-2">
            <button class="px-3 py-1 bg-pam-blue text-white rounded-lg text-sm">All</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Active</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Out of Stock</button>
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-sm text-pam-gray hover:bg-pam-gray-light/50">Drafts</button>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                <div class="absolute left-3 top-2.5 text-pam-gray">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
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
                @foreach ($products as $product)
                <tr class="hover:bg-pam-gray-light/50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-md overflow-hidden bg-pam-gray-light">
                               {{-- @dd($product->images) --}}
                                @if($product->images)
                                    @foreach(json_decode($product->images) as $imagePath)
                                        <img src="{{ asset('storage/'.$imagePath) }}" alt="Product image" class="h-full w-full object-cover">
                                    @endforeach
                                @else
                                    <img src="https://via.placeholder.com/80" alt="Product image" class="h-full w-full object-cover">
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-pam-blue">{{ $product->name }}</div>
                                <div class="text-xs text-pam-gray">{{ $product->category_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">{{ $product->sku }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">{{ $product->category_id }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">${{ number_format($product->price, 2) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-pam-gray">{{ $product->stock }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{-- @if($product->status === 'active')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        @elseif($product->status === 'draft')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Draft</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Archived</span>
                        @endif --}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3" onclick="openEditProductModal({{ $product->id }})">Edit</button>
                        <button class="text-red-500 hover:text-red-700" onclick="confirmDeleteProduct({{ $product->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <!-- Simple Pagination Links -->
    <div class="flex items-center justify-center mt-6">
        {{ $products->links() }}
    </div>
</div>

<!-- Add/Edit Product Modal -->
<div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-pam-blue" id="productModalTitle">Add New Product</h3>
                <button onclick="closeProductModal()" class="text-pam-gray hover:text-pam-blue">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="productForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="productId" name="id">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Left Column -->
                    <div>
                        <div class="mb-4">
                            <label for="productName" class="block text-sm font-medium text-pam-gray mb-1">Product Name *</label>
                            <input type="text" id="productName" name="name" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                        </div>
                        
                        <div class="mb-4">
                            <label for="productDescription" class="block text-sm font-medium text-pam-gray mb-1">Description</label>
                            <textarea id="productDescription" name="description" rows="4" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition"></textarea>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="productPrice" class="block text-sm font-medium text-pam-gray mb-1">Price ($) *</label>
                                <input type="number" id="productPrice" name="price" step="0.01" min="0" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                            </div>
                            
                            <div class="mb-4">
                                <label for="productComparePrice" class="block text-sm font-medium text-pam-gray mb-1">Compare At Price ($)</label>
                                <input type="number" id="productComparePrice" name="compare_price" step="0.01" min="0" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="productCost" class="block text-sm font-medium text-pam-gray mb-1">Cost per item ($)</label>
                                <input type="number" id="productCost" name="cost" step="0.01" min="0" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                            </div>
                            
                            <div class="mb-4">
                                <label for="productSKU" class="block text-sm font-medium text-pam-gray mb-1">SKU *</label>
                                <div class="flex">
                                    <input type="text" id="productSKU" name="sku" required readonly class="w-full border border-pam-gray-light rounded-l-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition bg-gray-50">
                                    <button type="button" onclick="generateSKU()" class="bg-pam-blue-light text-white px-3 py-2 rounded-r-lg hover:bg-pam-blue transition">Generate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-pam-gray mb-2">Product Images</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-pam-gray-light border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-pam-gray" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-pam-gray">
                                        <label for="productImages" class="relative cursor-pointer bg-white rounded-md font-medium text-pam-blue-light hover:text-pam-blue focus-within:outline-none">
                                            <span>Upload images</span>
                                            <input id="productImages" name="images[]" type="file" class="sr-only" multiple accept="image/*">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-pam-gray">PNG, JPG up to 5MB each</p>
                                </div>
                            </div>
                            <div id="uploadedImages" class="mt-2 grid grid-cols-4 gap-2">
                                <!-- Uploaded images will appear here -->
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="productCategory" class="block text-sm font-medium text-pam-gray mb-1">Category *</label>
                                <select 
                                    id="productCategory" 
                                    name="category_id" 
                                    required 
                                    class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition"
                                >
                                    <option value="" disabled selected>Select a category</option>
                                    <option value="1">Electronics</option>
                                    <option value="2">Clothing</option>
                                    <option value="3">Home & Garden</option>
                                    <option value="4">Books</option>
                                    <option value="5">Sports & Outdoors</option>
                                    <option value="6">Beauty</option>
                                </select>
                            </div>
                            
                            {{-- <div class="mb-4">
                                <label for="productStatus" class="block text-sm font-medium text-pam-gray mb-1">Status *</label>
                                <select id="productStatus" name="status" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                                    <option value="active">Active</option>
                                    <option value="draft">Draft</option>
                                    <option value="archived">Archived</option>
                                </select>
                            </div> --}}
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="productQuantity" class="block text-sm font-medium text-pam-gray mb-1">Quantity *</label>
                                <input type="number" id="productQuantity" name="stock" min="0" required class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                            </div>
                            
                            <div class="mb-4">
                                <label for="productWeight" class="block text-sm font-medium text-pam-gray mb-1">Weight (kg)</label>
                                <input type="number" id="productWeight" name="weight" step="0.01" min="0" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-pam-gray-light">
                    <button type="button" onclick="closeProductModal()" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-pam-green text-white rounded-lg hover:bg-green-600 transition">Save Product</button>
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
            
            <p class="text-pam-gray mb-6">Are you sure you want to delete this product? This action cannot be undone.</p>
            
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
    // Generate a unique SKU starting with pcm-
    function generateSKU() {
        const prefix = 'pcm-';
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let sku = prefix;
        
        // Add 6 random characters (mix of letters and numbers)
        for (let i = 0; i < 6; i++) {
            sku += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        
        // Add timestamp to ensure uniqueness
        sku += '-' + Date.now().toString().slice(-4);
        
        document.getElementById('productSKU').value = sku;
    }

    // Modal functions
    function openAddProductModal() {
        document.getElementById('productModalTitle').textContent = 'Add New Product';
        document.getElementById('productForm').reset();
        document.getElementById('productForm').action = "{{ route('vendor.products.store') }}";
        document.getElementById('productForm').setAttribute('method', 'POST');
        document.getElementById('productId').value = '';
        document.getElementById('uploadedImages').innerHTML = '';
        generateSKU(); // Auto-generate SKU for new products
        document.getElementById('productModal').classList.remove('hidden');
    }

    function openEditProductModal(productId) {
        // Fetch product data via AJAX
        fetch(`/vendor/products/${productId}/edit`)
            .then(response => response.json())
            .then(product => {
                document.getElementById('productModalTitle').textContent = 'Edit Product';
                document.getElementById('productForm').action = `/vendor/products/${productId}`;
                document.getElementById('productForm').setAttribute('method', 'POST');
                // Add hidden field for PUT method
                document.getElementById('productForm').innerHTML += '<input type="hidden" name="_method" value="PUT">';
                
                document.getElementById('productId').value = product.id;
                document.getElementById('productName').value = product.name;
                document.getElementById('productDescription').value = product.description;
                document.getElementById('productPrice').value = product.price;
                document.getElementById('productComparePrice').value = product.compare_price || '';
                document.getElementById('productCost').value = product.cost || '';
                document.getElementById('productSKU').value = product.sku;
                document.getElementById('productCategory').value = product.category_id;
                document.getElementById('productStatus').value = product.status;
                document.getElementById('productQuantity').value = product.stock;
                document.getElementById('productWeight').value = product.weight || '';
                
                // Set images
                const imagesContainer = document.getElementById('uploadedImages');
                imagesContainer.innerHTML = '';
                if (product.images && product.images.length > 0) {
                    product.images.forEach(image => {
                        const imgDiv = document.createElement('div');
                        imgDiv.className = 'relative';
                        imgDiv.innerHTML = `
                            <img src="${image.url}" alt="Product image" class="h-20 w-full object-cover rounded-md">
                            <button type="button" onclick="removeImage(this, ${image.id})" class="absolute top-1 right-1 bg-white rounded-full p-1 shadow-sm hover:bg-pam-gray-light/50">
                                <svg class="h-4 w-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        `;
                        imagesContainer.appendChild(imgDiv);
                    });
                }
                
                document.getElementById('productModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching product:', error);
                alert('Error loading product data');
            });
    }

    function closeProductModal() {
        document.getElementById('productModal').classList.add('hidden');
    }

    function confirmDeleteProduct(productId) {
        document.getElementById('deleteForm').action = `/vendor/products/${productId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Preview uploaded images
    document.getElementById('productImages').addEventListener('change', function(e) {
        const files = e.target.files;
        const imagesContainer = document.getElementById('uploadedImages');
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!file.type.match('image.*')) continue;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgDiv = document.createElement('div');
                imgDiv.className = 'relative';
                imgDiv.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="h-20 w-full object-cover rounded-md">
                    <button type="button" onclick="removeImagePreview(this)" class="absolute top-1 right-1 bg-white rounded-full p-1 shadow-sm hover:bg-pam-gray-light/50">
                        <svg class="h-4 w-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                `;
                imagesContainer.appendChild(imgDiv);
            };
            reader.readAsDataURL(file);
        }
    });

    function removeImagePreview(button) {
        button.parentElement.remove();
    }

    function removeImage(button, imageId) {
        if (confirm('Are you sure you want to delete this image?')) {
            fetch(`/vendor/product-images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    button.parentElement.remove();
                } else {
                    alert('Error deleting image');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting image');
            });
        }
    }

    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target === document.getElementById('productModal')) {
            closeProductModal();
        }
        
        if (event.target === document.getElementById('deleteModal')) {
            closeDeleteModal();
        }
    });
</script>
</x-vendor-nav>