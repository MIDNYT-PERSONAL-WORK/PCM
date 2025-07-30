<x-admin-nav>

<body class="font-sans bg-pam-gray-light">
    <!-- CSRF Token Meta Tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-pam-blue">Document Approvals</h1>
                <p class="text-pam-gray">Review and approve user submitted documents</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <!-- Filter Dropdown -->
                <div class="relative">
                    <select id="documentFilter" class="appearance-none bg-white border border-pam-gray-light text-pam-gray px-4 py-2 rounded-md hover:bg-pam-gray-light transition pr-8">
                        <option value="all">All Documents</option>
                        <option value="pending">Pending Approval</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-pam-gray">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents Table -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-pam-gray-light">
                    <thead class="bg-pam-gray-light">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Document Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Submitted</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-pam-gray-light">
                        @foreach ($documents as $document)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light flex items-center justify-center text-pam-blue font-medium">
                                        {{ substr($document->user->name, 0, 2) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-pam-blue">{{ $document->user->name }}</div>
                                        <div class="text-sm text-pam-gray">{{ $document->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col space-y-1">
                                    @php
                                        $types = [];
                                        if($document->government_id) $types[] = 'Government ID';
                                        if($document->proof_of_address) $types[] = 'Proof of Address';
                                        if($document->vehicle_registration) $types[] = 'Vehicle Registration';
                                        if($document->business_license) $types[] = 'Business License';
                                        if($document->insurance_certificate) $types[] = 'Insurance Certificate';
                                    @endphp
                                    @forelse($types as $type)
                                        <span class="text-sm text-pam-gray capitalize">{{ $type }}</span>
                                    @empty
                                        <span class="text-sm text-pam-gray capitalize">N/A</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-pam-gray">
                                {{ $document->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statuses = [];
                                    if($document->government_id) $statuses[] = $document->status_government_id ?? 'pending';
                                    if($document->proof_of_address) $statuses[] = $document->status_proof_of_address ?? 'pending';
                                    if($document->vehicle_registration) $statuses[] = $document->status_vehicle_registration ?? 'pending';
                                    if($document->business_license) $statuses[] = $document->status_business_license ?? 'pending';
                                    if($document->insurance_certificate) $statuses[] = $document->status_insurance_certificate ?? 'pending';
                                    
                                    $overallStatus = 'pending';
                                    if(count($statuses) > 0) {
                                        if(count(array_filter($statuses, function($s) { return $s === 'approved'; })) === count($statuses)) {
                                            $overallStatus = 'approved';
                                        } elseif(in_array('rejected', $statuses)) {
                                            $overallStatus = 'rejected';
                                        }
                                    }
                                    // dd($overallStatus,$statuses);
                                @endphp
                                @if($overallStatus === 'approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pam-green text-white">
                                        Approved
                                    </span>
                                @elseif($overallStatus === 'rejected')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pam-red text-white">
                                        Rejected
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pam-orange text-white">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <!-- View Document Button -->
                                    <button onclick="openDocumentModal('{{ $document->id }}')" class="text-pam-blue-light hover:text-pam-blue" title="View Document">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="none" viewBox="0 0 24 24" stroke="#3d3bb0">
                                            <path stroke="#3d3bb0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M1.75 12S5 5.75 12 5.75 22.25 12 22.25 12 19 18.25 12 18.25 1.75 12 1.75 12Z"/>
                                            <circle cx="12" cy="12" r="3" stroke="#3d3bb0" stroke-width="2"/>
                                        </svg>
                                    </button>

                                    <!-- Approve Button -->
                                    @if($overallStatus !== 'approved')
                                    <button onclick="approveDocument('{{ $document->id }}')" class="text-pam-green hover:text-pam-green-light" title="Approve Document">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </button>
                                    @endif

                                    <!-- Reject Button -->
                                    @if($overallStatus !== 'rejected')
                                    <button onclick="openRejectModal('{{ $document->id }}')" class="text-pam-red hover:text-pam-red-light" title="Reject Document">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                        </svg>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-right justify-between border-t border-pam-gray-light sm:px-6 mt-4 rounded-b-lg">
            <div class="hidden spacing-4 sm:flex-1 sm:flex sm:items-center sm:justify-between">
                {{ $documents->links() }}
            </div>
        </div>
    </div>

    <!-- Document View Modal -->
    <div id="documentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg max-w-4xl w-full p-6 mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-pam-blue">Document Review</h3>
                <button onclick="closeDocumentModal()" class="text-pam-gray hover:text-pam-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div id="documentContent" class="mb-6 relative">
                <!-- Document preview will be loaded here -->
                <div id="documentLoading" class="flex flex-col justify-center items-center h-64 bg-pam-gray-light rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-pam-blue" fill="none" viewBox="0 0 48 48">
                        <rect width="48" height="48" rx="8" fill="#F3F4F6"/>
                        <g>
                            <rect x="12" y="10" width="24" height="28" rx="2" fill="#E53E3E"/>
                            <rect x="16" y="16" width="16" height="2.5" rx="1.25" fill="#fff"/>
                            <rect x="16" y="21" width="16" height="2.5" rx="1.25" fill="#fff"/>
                            <rect x="16" y="26" width="10" height="2.5" rx="1.25" fill="#fff"/>
                            <text x="24" y="38" text-anchor="middle" font-size="8" fill="#fff" font-family="Arial, sans-serif" font-weight="bold">PDF</text>
                        </g>
                    </svg>
                    <p class="text-pam-gray">Loading document...</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <h4 class="text-sm font-medium text-pam-gray mb-2">User Information</h4>
                    <div class="bg-pam-gray-light p-4 rounded-lg">
                        <p id="userName" class="font-medium text-pam-blue"></p>
                        <p id="userEmail" class="text-sm text-pam-gray"></p>
                        <p id="userPhone" class="text-sm text-pam-gray mt-2"></p>
                        <p id="userRole" class="text-xs text-pam-gray mt-2 capitalize"></p>
                    </div>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-pam-gray mb-2">Document Details</h4>
                    <div class="bg-pam-gray-light p-4 rounded-lg">
                        <p id="docType" class="font-medium text-pam-blue"></p>
                        <p id="docStatus" class="text-sm text-pam-gray mt-2"></p>
                        <p id="docSubmitted" class="text-sm text-pam-gray"></p>
                        <p id="docUpdated" class="text-xs text-pam-gray mt-2"></p>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 pt-4 border-t border-pam-gray-light">
                <button onclick="closeDocumentModal()" class="bg-white py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-gray hover:bg-pam-gray-light">
                    Close
                </button>
                <button id="approveAllBtn" class="bg-pam-green py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-pam-green-light">
                    Approve All
                </button>
                <button id="rejectAllBtn" class="bg-pam-red py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-pam-red-light">
                    Reject All
                </button>
            </div>
        </div>
    </div>

    <!-- Reject Document Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg max-w-md w-full p-6 mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-pam-red">Reject Document</h3>
                <button onclick="closeRejectModal()" class="text-pam-gray hover:text-pam-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <form id="rejectForm">
                <input type="hidden" id="rejectDocId">
                <input type="hidden" id="rejectDocType">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-pam-gray mb-1">Reason for Rejection</label>
                    <select id="rejectReason" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue mb-2">
                        <option value="">Select a reason</option>
                        <option value="blurry">Blurry/Unreadable</option>
                        <option value="expired">Expired Document</option>
                        <option value="incomplete">Incomplete Information</option>
                        <option value="mismatch">Information Mismatch</option>
                        <option value="other">Other</option>
                    </select>
                    <textarea id="rejectDetails" rows="3" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue" placeholder="Additional details..."></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeRejectModal()" class="bg-white py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-gray hover:bg-pam-gray-light">
                        Cancel
                    </button>
                    <button type="submit" class="bg-pam-red py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-pam-red-light">
                        Confirm Rejection
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
let currentDocumentId = null;
let currentDocumentUrl = null;
let currentDocumentType = null;
let currentDocuments = [];
let currentDocumentStatus = null;

// Document Modal Functions
function openDocumentModal(documentId) {
    currentDocumentId = documentId;
    const modal = document.getElementById('documentModal');
    modal.classList.remove('hidden');
    
    // Show loading state
    document.getElementById('documentContent').innerHTML = `
        <div id="documentLoading" class="flex flex-col justify-center items-center h-64 bg-pam-gray-light rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-pam-blue" fill="none" viewBox="0 0 48 48">
                <rect width="48" height="48" rx="8" fill="#F3F4F6"/>
                <g>
                    <rect x="12" y="10" width="24" height="28" rx="2" fill="#E53E3E"/>
                    <rect x="16" y="16" width="16" height="2.5" rx="1.25" fill="#fff"/>
                    <rect x="16" y="21" width="16" height="2.5" rx="1.25" fill="#fff"/>
                    <rect x="16" y="26" width="10" height="2.5" rx="1.25" fill="#fff"/>
                    <text x="24" y="38" text-anchor="middle" font-size="8" fill="#fff" font-family="Arial, sans-serif" font-weight="bold">PDF</text>
                </g>
            </svg>
            <p class="text-pam-gray">Loading document...</p>
        </div>
    `;
    
    // Load document details via AJAX
    fetch(`/documents/${documentId}`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Calculate overall status
            const statuses = [];
            if(data.government_id) statuses.push(data.status_government_id || 'pending');
            if(data.proof_of_address) statuses.push(data.status_proof_of_address || 'pending');
            if(data.vehicle_registration) statuses.push(data.status_vehicle_registration || 'pending');
            if(data.business_license) statuses.push(data.status_business_license || 'pending');
            if(data.insurance_certificate) statuses.push(data.status_insurance_certificate || 'pending');
            
            let overallStatus = 'pending';
            if(statuses.length > 0) {
                if(statuses.every(s => s === 'approved')) {
                    overallStatus = 'approved';
                } else if(statuses.some(s => s === 'rejected')) {
                    overallStatus = 'rejected';
                }
            }
            
            currentDocumentStatus = overallStatus;
            
            // Update modal content
            document.getElementById('userName').textContent = data.user.name;
            document.getElementById('userEmail').textContent = data.user.email;
            document.getElementById('userPhone').textContent = data.user.phone || 'N/A';
            document.getElementById('userRole').textContent = data.user.role;
            
            // Document details
            const docTypes = [];
            if(data.government_id) docTypes.push('Government ID');
            if(data.proof_of_address) docTypes.push('Proof of Address');
            if(data.vehicle_registration) docTypes.push('Vehicle Registration');
            if(data.business_license) docTypes.push('Business License');
            if(data.insurance_certificate) docTypes.push('Insurance Certificate');
            
            document.getElementById('docType').textContent = docTypes.join(', ');
            document.getElementById('docStatus').innerHTML = `Status: <span class="${getStatusClass(overallStatus)}">${overallStatus}</span>`;
            document.getElementById('docSubmitted').textContent = `Submitted: ${new Date(data.created_at).toLocaleString()}`;
            document.getElementById('docUpdated').textContent = `Last updated: ${new Date(data.updated_at).toLocaleString()}`;
            
            // Load document preview
            const docContent = document.getElementById('documentContent');
            docContent.innerHTML = '';
            
            // Handle multiple documents
            currentDocuments = [];
            if(data.government_id) currentDocuments.push({
                type: 'Government ID', 
                url: data.government_id, 
                status: data.status_government_id || 'pending',
                dbField: 'government_id'
            });
            if(data.proof_of_address) currentDocuments.push({
                type: 'Proof of Address', 
                url: data.proof_of_address, 
                status: data.status_proof_of_address || 'pending',
                dbField: 'proof_of_address'
            });
            if(data.vehicle_registration) currentDocuments.push({
                type: 'Vehicle Registration', 
                url: data.vehicle_registration, 
                status: data.status_vehicle_registration || 'pending',
                dbField: 'vehicle_registration'
            });
            if(data.business_license) currentDocuments.push({
                type: 'Business License', 
                url: data.business_license, 
                status: data.status_business_license || 'pending',
                dbField: 'business_license'
            });
            if(data.insurance_certificate) currentDocuments.push({
                type: 'Insurance Certificate', 
                url: data.insurance_certificate, 
                status: data.status_insurance_certificate || 'pending',
                dbField: 'insurance_certificate'
            });
            
            if(currentDocuments.length > 0) {
                // Create container for document preview and actions
                const container = document.createElement('div');
                container.className = 'relative';
                
                // Create download all button
                const downloadAllBtn = document.createElement('div');
                downloadAllBtn.className = 'flex justify-end mb-4';
                downloadAllBtn.innerHTML = `
                    <button onclick="downloadAllDocuments()" class="bg-pam-blue text-white px-4 py-2 rounded shadow hover:bg-pam-blue-light flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                        </svg>
                        <span>Download All</span>
                    </button>
                `;
                container.appendChild(downloadAllBtn);

                // Create document grid
                const gridContainer = document.createElement('div');
                gridContainer.className = 'grid grid-cols-1 md:grid-cols-2 gap-4';
                
                currentDocuments.forEach((doc, index) => {
                    const docCard = document.createElement('div');
                    docCard.className = 'bg-pam-gray-light rounded-lg p-4 border border-pam-gray-light';
                    
                    // Document header with actions
                    const header = document.createElement('div');
                    header.className = 'flex justify-between items-center mb-3';
                    header.innerHTML = `
                        <h4 class="font-medium text-pam-blue">${doc.type}</h4>
                        <div class="flex space-x-2">
                            <a href="/download/document/${doc.url.split('/').pop()}" download class="text-pam-blue hover:text-pam-blue-light">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                                </svg>
                            </a>
                            ${doc.status !== 'approved' ? `
                            <button onclick="approveSingleDocument('${currentDocumentId}', '${doc.dbField}')" class="text-pam-green hover:text-pam-green-light" title="Approve">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </button>
                            ` : ''}
                            ${doc.status !== 'rejected' ? `
                            <button onclick="openRejectSingleModal('${currentDocumentId}', '${doc.dbField}')" class="text-pam-red hover:text-pam-red-light" title="Reject">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                            </button>
                            ` : ''}
                        </div>
                    `;
                    docCard.appendChild(header);
                    
                    // Document status badge - using the actual doc.status
                    const statusBadge = document.createElement('div');
                    statusBadge.className = 'mb-3';
                    statusBadge.innerHTML = `
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(doc.status, true)}">
                            ${doc.status}
                        </span>
                    `;
                    docCard.appendChild(statusBadge);
                    
                    // Document preview
                    const previewContainer = document.createElement('div');
                    previewContainer.className = 'h-64 overflow-hidden rounded bg-white flex items-center justify-center';
                    previewContainer.appendChild(createDocumentPreview(doc.url, true));
                    
                    docCard.appendChild(previewContainer);
                    gridContainer.appendChild(docCard);
                });
                
                container.appendChild(gridContainer);
                docContent.appendChild(container);
                
                // Update action buttons based on status
                const approveAllBtn = document.getElementById('approveAllBtn');
                const rejectAllBtn = document.getElementById('rejectAllBtn');
                
                // Check if all documents are approved
                const allApproved = currentDocuments.every(doc => doc.status === 'approved');
                const anyRejected = currentDocuments.some(doc => doc.status === 'rejected');
                
                if(allApproved) {
                    approveAllBtn.disabled = true;
                    approveAllBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    rejectAllBtn.classList.remove('hidden');
                } else if(anyRejected) {
                    rejectAllBtn.disabled = true;
                    rejectAllBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    approveAllBtn.classList.remove('hidden');
                } else {
                    approveAllBtn.disabled = false;
                    rejectAllBtn.disabled = false;
                    approveAllBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    rejectAllBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
                
                // Set up button handlers
                approveAllBtn.onclick = () => approveCurrentDocument();
                rejectAllBtn.onclick = () => openRejectCurrentModal();
            }
        })
        .catch(error => {
            console.error('Error loading document:', error);
            document.getElementById('documentContent').innerHTML = `
                <div class="bg-pam-red-50 border border-pam-red-200 rounded p-4 text-pam-red-600">
                    Failed to load document. Please try again. Error: ${error.message}
                </div>
            `;
        });
}

function closeDocumentModal() {
    document.getElementById('documentModal').classList.add('hidden');
}

function createDocumentPreview(url, isThumbnail = false) {
    const container = document.createElement('div');
    container.className = 'w-full h-full flex justify-center items-center';
    
    // Extract filename
    const filename = url.split('/').pop();
    const fileExtension = filename.split('.').pop().toLowerCase();
    
    if(fileExtension === 'pdf') {
        // For PDFs, use an iframe or object tag
        if (isThumbnail) {
            // Thumbnail view - show PDF icon with download option
            container.innerHTML = `
                <div class="text-center p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-pam-red" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <p class="mt-2 text-sm text-pam-gray">PDF Document</p>
                    <a href="/download/document/${filename}" class="mt-2 inline-block text-sm text-pam-blue hover:underline">View Full</a>
                </div>
            `;
        } else {
            // Full view - show PDF preview
            const pdfContainer = document.createElement('div');
            pdfContainer.className = 'w-full h-full';
            
            const objectTag = document.createElement('object');
            objectTag.data = `/storage/${url}`;
            objectTag.type = 'application/pdf';
            objectTag.className = 'w-full h-full border border-pam-gray-light';
            objectTag.setAttribute('aria-label', 'PDF document preview');
            
            // Fallback content
            const fallback = document.createElement('div');
            fallback.className = 'bg-pam-gray-light p-4 rounded-lg text-center';
            fallback.innerHTML = `
                <p class="text-pam-gray mb-2">PDF preview not available in your browser</p>
                <a href="/download/document/${filename}" download class="text-pam-blue hover:underline">
                    Download PDF document
                </a>
            `;
            
            objectTag.appendChild(fallback);
            pdfContainer.appendChild(objectTag);
            container.appendChild(pdfContainer);
        }
    } 
    else if(['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
        // For images
        const imgContainer = document.createElement('div');
        imgContainer.className = 'w-full h-full flex justify-center items-center';
        
        const img = document.createElement('img');
        img.src = `/storage/${url}`;
        img.alt = 'Document preview';
        img.className = isThumbnail ? 'max-h-full max-w-full object-contain' : 'max-h-full max-w-full object-contain border border-pam-gray-light rounded-lg shadow-sm';
        img.style.maxHeight = isThumbnail ? '100%' : 'calc(100vh - 400px)';
        img.onerror = function() {
            imgContainer.innerHTML = `
                <div class="bg-pam-gray-light p-4 rounded-lg text-center">
                    <p class="text-pam-gray mb-2">Preview not available</p>
                    <a href="/download/document/${filename}" download class="text-pam-blue hover:underline">
                        Download document
                    </a>
                </div>
            `;
        };
        
        imgContainer.appendChild(img);
        container.appendChild(imgContainer);
    } 
    else {
        // Unsupported format
        container.innerHTML = `
            <div class="bg-pam-gray-light p-4 rounded-lg text-center">
                <p class="text-pam-gray mb-2">Preview not available for this file type</p>
                <a href="/download/document/${filename}" download class="text-pam-blue hover:underline">
                    Download document
                </a>
            </div>
        `;
    }
    
    return container;
}

function downloadAllDocuments() {
    currentDocuments.forEach(doc => {
        const link = document.createElement('a');
        link.href = `/download/document/${doc.url.split('/').pop()}`;
        link.download = true;
        link.style.display = 'none';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        // Small delay between downloads to avoid browser blocking
        return new Promise(resolve => setTimeout(resolve, 200));
    });
}

function getStatusClass(status, isBadge = false) {
    if (isBadge) {
        switch(status) {
            case 'approved': return 'bg-pam-green text-white';
            case 'rejected': return 'bg-pam-red text-white';
            default: return 'bg-pam-orange text-white';
        }
    } else {
        switch(status) {
            case 'approved': return 'text-pam-green';
            case 'rejected': return 'text-pam-red';
            default: return 'text-pam-orange';
        }
    }
}

// Document Approval Functions
function approveDocument(documentId, documentType = null) {
    const action = documentType ? `approve this ${documentType.replace('_', ' ')}` : 'approve all documents';
    if(confirm(`Are you sure you want to ${action}?`)) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
        if (!csrfToken) {
            console.error('CSRF token not found');
            alert('Security error. Please refresh the page and try again.');
            return;
        }
        
        fetch(`/admin/documents/${documentId}/approve`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                document_type: documentType || 'all'
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if(data.success) {
                alert(`${documentType ? documentType.replace('_', ' ') : 'Documents'} approved successfully!`);
                window.location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(`Failed to approve ${action}. Please check your network connection and try again.`);
        });
    }
}

function approveSingleDocument(documentId, documentType) {
    approveDocument(documentId, documentType);
}

function approveCurrentDocument() {
    if(currentDocumentId) {
        approveDocument(currentDocumentId);
    }
}

// Reject Document Functions
function openRejectModal(documentId, documentType = null) {
    document.getElementById('rejectDocId').value = documentId;
    document.getElementById('rejectDocType').value = documentType || 'all';
    document.getElementById('rejectModal').classList.remove('hidden');
}

function openRejectSingleModal(documentId, documentType) {
    document.getElementById('rejectDocId').value = documentId;
    document.getElementById('rejectDocType').value = documentType;
    document.getElementById('rejectModal').classList.remove('hidden');
    closeDocumentModal();
}

function openRejectCurrentModal() {
    if(currentDocumentId) {
        openRejectModal(currentDocumentId);
        closeDocumentModal();
    }
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

document.getElementById('rejectForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const documentId = document.getElementById('rejectDocId').value;
    const documentType = document.getElementById('rejectDocType').value;
    const reason = document.getElementById('rejectReason').value;
    const details = document.getElementById('rejectDetails').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    if(!reason) {
        alert('Please select a reason for rejection');
        return;
    }
    
    if (!csrfToken) {
        console.error('CSRF token not found');
        alert('Security error. Please refresh the page and try again.');
        return;
    }
    
    fetch(`/admin/documents/${documentId}/reject`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            document_type: documentType,
            reason: reason,
            details: details
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if(data.success) {
            alert('Document rejected successfully!');
            window.location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to reject document. Please check your network connection and try again.');
    });
});

// Filter documents
document.getElementById('documentFilter').addEventListener('change', function() {
    const status = this.value;
    window.location.href = `/admin/documents?status=${status}`;
});
</script>
</body>
</html>
</x-admin-nav>