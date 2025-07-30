<x-admin-nav>

<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Page Header with Tabs -->
    <div class="border-b border-pam-gray-light mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-pam-blue">Vendor Management</h2>
                <p class="text-pam-gray">Manage vendor accounts, approvals, and performance</p>
            </div>
            {{-- <div class="mt-4 md:mt-0">
                <button class="bg-pam-blue hover:bg-pam-blue-light text-white px-4 py-2 rounded-lg flex items-center transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add New Vendor
                </button>
            </div> --}}
        </div>
        
        {{-- <div class="flex space-x-4">
            <button class="px-4 py-2 font-medium border-b-2 border-pam-blue text-pam-blue">All Vendors</button>
            <button class="px-4 py-2 font-medium text-pam-gray hover:text-pam-blue">Pending Approval</button>
            <button class="px-4 py-2 font-medium text-pam-gray hover:text-pam-blue">Active Vendors</button>
            <button class="px-4 py-2 font-medium text-pam-gray hover:text-pam-blue">Suspended</button>
        </div> --}}
    </div>

    <!-- Vendor Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Total Vendors</div>
            <div class="text-2xl font-bold text-pam-blue">{{ $TotalVendors->count() }}</div>
            <div class="text-xs text-pam-green flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                12% from last month
            </div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Pending Approval</div>
            <div class="text-2xl font-bold text-pam-blue">{{$TotalPendingApproval}}</div>
            <div class="text-xs text-pam-gray">Requires action</div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Active Vendors</div>
            <div class="text-2xl font-bold text-pam-blue">{{$TotalActiveVendors}}</div>
            <div class="text-xs text-pam-green flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                5% from last month
            </div>
        </div>
        <div class="bg-pam-gray-light rounded-lg p-4">
            <div class="text-sm font-medium text-pam-gray">Suspended</div>
            <div class="text-2xl font-bold text-pam-blue">{{$TotalSuspended}}</div>
            <div class="text-xs text-pam-gray">Needs review</div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
    <div class="relative flex-grow max-w-md">
        <input type="text" placeholder="Search vendors..." class="w-full pl-10 pr-4 py-2 border border-pam-gray-light rounded-lg focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
        <div class="absolute left-3 top-2.5 text-pam-gray">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
    </div>
    <div class="flex items-center gap-2">
        {{-- <select class="border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
            <option>All Categories</option>
            <option>Logistics</option>
            <option>Warehousing</option>
            <option>Freight</option>
            <option>Courier</option>
        </select> --}}
        <select class="border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
            <option>Sort by: Newest</option>
            <option>Sort by: Rating</option>
            <option>Sort by: Orders</option>
        </select>
    </div>
</div>

<!-- Vendors Table -->
<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-pam-gray-light">
        <thead class="bg-pam-gray-light">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Vendor</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Category</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Contact</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Rating</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-pam-gray uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-pam-gray-light">
            @foreach($vendors as $vendor)
            <tr class="hover:bg-pam-gray-light/50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-pam-gray-light rounded-lg flex items-center justify-center">
                            <span class="text-pam-blue font-medium">{{ substr($vendor->name, 0, 2) }}</span>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-pam-blue">{{ $vendor->name }}</div>
                            <div class="text-sm text-pam-gray">Registered: {{ $vendor->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-pam-gray">
                        {{ $vendor->category ?? 'N/A' }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-pam-gray">{{ $vendor->email }}</div>
                    <div class="text-sm text-pam-gray">{{ $vendor->phone ?? 'N/A' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        @if(($vendor->rating ?? 0) > 0)
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="ml-1 text-sm text-pam-gray">
                                {{ number_format($vendor->rating, 1) }} ({{ $vendor->reviews_count ?? 0 }})
                            </span>
                        @else
                            <span class="ml-1 text-sm text-pam-gray">New</span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($vendor->is_active == 'active')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                    @elseif($vendor->is_active == 'pending')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending Approval</span>
                    @elseif($vendor->is_active == 'inactive')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Suspended</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    @if($vendor->is_active == 'pending')
                        <button class="text-pam-green hover:text-green-700 mr-3" onclick="openVendorModal('approve', {{ $vendor->id }})">Approve</button>
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">View</button>
                        <button class="text-red-500 hover:text-red-700" onclick="rejectVendor({{ $vendor->id }})">Reject</button>
                    @elseif($vendor->is_active == 'active')
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">View</button>
                        <button class="text-pam-green hover:text-green-700 mr-3">Edit</button>
                        <button class="text-red-500 hover:text-red-700" onclick="suspendVendor({{ $vendor->id }})">Suspend</button>
                    @elseif($vendor->is_active == 'inactive')
                        <button class="text-pam-blue-light hover:text-pam-blue mr-3">View</button>
                        <button class="text-pam-green hover:text-green-700 mr-3" onclick="reactivateVendor({{ $vendor->id }})">Reactivate</button>
                        <button class="text-red-500 hover:text-red-700" onclick="deleteVendor({{ $vendor->id }})">Delete</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="flex items-center justify-between mt-6">
    <div class="text-sm text-pam-gray">
        Showing <span class="font-medium">{{ $vendors->firstItem() }}</span> to <span class="font-medium">{{ $vendors->lastItem() }}</span> of <span class="font-medium">{{ $vendors->total() }}</span> vendors
    </div>
    <div class="flex space-x-2">
        @if($vendors->onFirstPage())
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50 disabled:opacity-50" disabled>
                Previous
            </button>
        @else
            <a href="{{ $vendors->previousPageUrl() }}" class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50">
                Previous
            </a>
        @endif

        @foreach(range(1, $vendors->lastPage()) as $page)
            @if($page == $vendors->currentPage())
                <span class="px-3 py-1 border border-pam-blue-light bg-pam-blue-light text-white rounded-lg">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $vendors->url($page) }}" class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        @if($vendors->hasMorePages())
            <a href="{{ $vendors->nextPageUrl() }}" class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50">
                Next
            </a>
        @else
            <button class="px-3 py-1 border border-pam-gray-light rounded-lg text-pam-gray hover:bg-pam-gray-light/50 disabled:opacity-50" disabled>
                Next
            </button>
        @endif
    </div>
</div>
</div>

<!-- Vendor Approval Modal (hidden by default) -->
<div id="vendorModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-pam-blue">Approve Vendor</h3>
                <button onclick="closeVendorModal()" class="text-pam-gray hover:text-pam-blue">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <div class="mb-4">
                <p class="text-pam-gray mb-2">You are about to approve <span class="font-medium">Speedy Logistics</span> as a vendor.</p>
                <p class="text-pam-gray">This will grant them full access to the vendor portal.</p>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-pam-gray mb-2">Service Level</label>
                <select class="w-full border border-pam-gray-light rounded-lg px-3 py-2 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    <option>Standard</option>
                    <option>Premium</option>
                    <option>Enterprise</option>
                </select>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-pam-gray mb-2">Commission Rate</label>
                <div class="relative">
                    <input type="text" value="15" class="w-full border border-pam-gray-light rounded-lg px-3 py-2 pr-8 focus:ring-2 focus:ring-pam-blue-light focus:border-pam-blue-light outline-none transition">
                    <span class="absolute right-3 top-2 text-pam-gray">%</span>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button onclick="closeVendorModal()" class="px-4 py-2 border border-pam-gray-light text-pam-gray rounded-lg hover:bg-pam-gray-light/50 transition">Cancel</button>
                <button class="px-4 py-2 bg-pam-green text-white rounded-lg hover:bg-green-600 transition">Approve Vendor</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Vendor modal functions
    function openVendorModal(action) {
        const modal = document.getElementById('vendorModal');
        if (action === 'approve') {
            modal.querySelector('h3').textContent = 'Approve Vendor';
            modal.querySelector('button:last-child').textContent = 'Approve Vendor';
            modal.querySelector('button:last-child').className = 'px-4 py-2 bg-pam-green text-white rounded-lg hover:bg-green-600 transition';
        } else if (action === 'reject') {
            modal.querySelector('h3').textContent = 'Reject Vendor';
            modal.querySelector('button:last-child').textContent = 'Reject Vendor';
            modal.querySelector('button:last-child').className = 'px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition';
        }
        modal.classList.remove('hidden');
    }

     function openVendorModal(action, id) {
        // Implement modal opening logic
        console.log(action, id);
    }

    function approveVendor(id) {
        if(confirm('Are you sure you want to approve this vendor?')) {
            // AJAX call to approve vendor
            fetch(`/admin/vendors/${id}/approve`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
        }
    }

    function rejectVendor(id) {
        if(confirm('Are you sure you want to reject this vendor?')) {
            // AJAX call to reject vendor
            fetch(`/admin/vendors/${id}/reject`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
        }
    }

    function suspendVendor(id) {
        if(confirm('Are you sure you want to suspend this vendor?')) {
            // AJAX call to suspend vendor
            fetch(`/admin/vendors/${id}/suspend`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
        }
    }

    function reactivateVendor(id) {
        if(confirm('Are you sure you want to reactivate this vendor?')) {
            // AJAX call to reactivate vendor
            fetch(`/admin/vendors/${id}/reactivate`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
        }
    }

    function deleteVendor(id) {
        if(confirm('Are you sure you want to delete this vendor? This action cannot be undone.')) {
            // AJAX call to delete vendor
            fetch(`/admin/vendors/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
        }
    }

    function closeVendorModal() {
        document.getElementById('vendorModal').classList.add('hidden');
    }
</script>

</x-admin-nav>