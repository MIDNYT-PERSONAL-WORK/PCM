<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Submission | PAM Logistics</title>
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
                        'pam-orange': '#f97316',
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
        .file-input-label {
            border: 2px dashed #d1d5db;
            transition: all 0.3s;
        }
        .file-input-label:hover {
            border-color: #3b82f6;
            background-color: #f8fafc;
        }
        .file-input-label.dragover {
            border-color: #3b82f6;
            background-color: #f0f7ff;
        }
        .document-card {
            transition: all 0.3s;
        }
        .document-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
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
                    <div class="relative">
                        <button class="flex items-center text-sm rounded-full focus:outline-none">
                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-pam-blue text-white font-bold text-lg">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="ml-2 text-sm font-medium text-pam-gray hidden md:inline">{{ auth()->user()->name }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-pam-blue mb-2">Document Submission</h1>
                    <p class="text-pam-gray">Submit your legal documents for verification</p>
                </div>
                <div class="flex items-center space-x-2">
                    <span id="role-badge" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-pam-green/10 text-pam-green">
                        <svg class="-ml-1 mr-1.5 h-2 w-2 text-pam-green" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        {{ auth()->user()->role }}
                    </span>
                </div>
            </div>
            
            <!-- Progress Steps -->
            <div class="mt-6">
                <nav class="flex items-center justify-center">
                    <ol class="flex items-center space-x-8">
                        <li class="flex items-center">
                            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-pam-blue text-white font-medium">
                                1
                            </span>
                            <span class="ml-3 text-sm font-medium text-pam-blue">Account Setup</span>
                        </li>
                        <li class="flex items-center">
                            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-pam-blue text-white font-medium">
                                2
                            </span>
                            <span class="ml-3 text-sm font-medium text-pam-blue">Document Upload</span>
                        </li>
                        <li class="flex items-center">
                            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-pam-gray-light text-pam-gray font-medium">
                                3
                            </span>
                            <span class="ml-3 text-sm font-medium text-pam-gray">Verification</span>
                        </li>
                        <li class="flex items-center">
                            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-pam-gray-light text-pam-gray font-medium">
                                4
                            </span>
                            <span class="ml-3 text-sm font-medium text-pam-gray">Approval</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Document Submission Card -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            @if(session('error'))
                <div class="bg-pam-red-50 border-l-4 border-pam-red p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-pam-red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-pam-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(auth()->user()->document)
                <!-- Show this if documents have been submitted -->
                <div class="p-6">
                    @php
                        $hasRejected = false;
                        $document = auth()->user()->document;
                        $statusFields = [
                            'government_id' => 'Government ID',
                            'proof_of_address' => 'Proof of Address',
                            'vehicle_registration' => 'Vehicle Registration',
                            'business_license' => 'Business License',
                            'insurance_certificate' => 'Insurance Certificate'
                        ];
                        
                        foreach ($statusFields as $field => $label) {
                            $statusField = 'status_' . $field;
                            if ($document->$statusField === 'rejected') {
                                $hasRejected = true;
                                break;
                            }
                        }
                    @endphp

                    @if(!$hasRejected)
                        <div class="bg-pam-green-50 border-l-4 border-pam-green p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-pam-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-pam-green-700">Your documents have been submitted and are under review. You'll be notified once they're approved.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-pam-orange-50 border-l-4 border-pam-orange p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-pam-orange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-pam-orange-700">Some of your documents were rejected. Please review the rejected documents below and upload new versions.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <h2 class="text-xl font-semibold text-pam-blue mb-4">Submitted Documents</h2>
                    
                    <div class="space-y-4">
                        @foreach($statusFields as $field => $label)
                            @if($document->$field)
                                <div class="border border-pam-gray-light rounded-lg p-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h3 class="font-medium text-pam-blue">{{ $label }}</h3>
                                            <p class="text-sm text-pam-gray">Submitted: {{ $document->created_at->format('M d, Y H:i') }}</p>
                                        </div>
                                        <div>
                                            @php
                                                $statusField = 'status_' . $field;
                                                $status = $document->$statusField ?? 'pending';
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($status === 'approved') bg-pam-green text-white
                                                @elseif($status === 'rejected') bg-pam-red text-white
                                                @else bg-pam-orange text-white @endif">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </div>
                                    </div>
                                    @if($status === 'rejected')
                                        <div class="mt-2 text-sm text-pam-red">
                                            <p>This document was rejected. Please upload a new version.</p>
                                            @if($document->rejection_reason)
                                                <p class="mt-1"><strong>Reason:</strong> {{ $document->rejection_reason }}</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                    
                    <!-- Show form for rejected documents -->
                    @if($hasRejected)
                        <div class="mt-8 pt-6 border-t border-pam-gray-light">
                            <h2 class="text-xl font-semibold text-pam-blue mb-4">Re-upload Rejected Documents</h2>
                            <form id="document-form" method="POST" action="{{ route('documents.submit') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="space-y-6">
                                    @foreach($statusFields as $field => $label)
                                        @php
                                            $statusField = 'status_' . $field;
                                            $status = $document->$statusField ?? 'pending';
                                        @endphp
                                        
                                        @if($status === 'rejected')
                                            <div>
                                                <label class="block text-sm font-medium text-pam-gray mb-1">{{ $label }} <span class="text-pam-red">*</span></label>
                                                <div class="mt-1">
                                                    <label for="{{ $field }}" class="file-input-label flex flex-col items-center justify-center px-6 py-10 border-2 border-dashed rounded-lg cursor-pointer text-center">
                                                        <div class="flex items-center">
                                                            <i class="fas fa-cloud-upload-alt text-3xl text-pam-blue mr-2"></i>
                                                            <span class="text-pam-blue font-medium">Click to upload</span>
                                                        </div>
                                                        <p class="mt-1 text-xs text-pam-gray">or drag and drop</p>
                                                        <p class="mt-1 text-xs text-pam-gray">PDF, JPG, PNG up to 5MB</p>
                                                        <input id="{{ $field }}" name="{{ $field }}" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png" required>
                                                    </label>
                                                </div>
                                                <div id="{{ $field }}-preview" class="mt-2 hidden">
                                                    <!-- Preview will appear here -->
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    
                                    <!-- Terms and Conditions -->
                                    <div class="mb-8">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="terms" name="terms" type="checkbox" class="focus:ring-pam-blue h-4 w-4 text-pam-blue border-pam-gray-light rounded" required>
                                            </div>
                                            <div class="ml-3">
                                                <label for="terms" class="text-sm text-pam-gray">
                                                    I certify that all documents submitted are valid, unaltered, and belong to me. I understand that providing false information may result in account termination.
                                                    <span class="text-pam-red">*</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="flex items-start mt-4">
                                            <div class="flex items-center h-5">
                                                <input id="privacy" name="privacy" type="checkbox" class="focus:ring-pam-blue h-4 w-4 text-pam-blue border-pam-gray-light rounded" required>
                                            </div>
                                            <div class="ml-3">
                                                <label for="privacy" class="text-sm text-pam-gray">
                                                    I agree to the <a href="#" class="text-pam-blue hover:underline">Privacy Policy</a> and <a href="#" class="text-pam-blue hover:underline">Terms of Service</a>.
                                                    <span class="text-pam-red">*</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Submission Buttons -->
                                    <div class="flex justify-between pt-4 border-t border-pam-gray-light">
                                        <button type="button" class="inline-flex items-center px-4 py-2 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-gray bg-white hover:bg-pam-gray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue">
                                            <i class="fas fa-arrow-left mr-2"></i> Back
                                        </button>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pam-blue hover:bg-pam-blue-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue">
                                            Submit Documents
                                            <i class="fas fa-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            @else
                <!-- Show the full form if no documents submitted -->
                <form id="document-form" class="p-6" method="POST" action="{{ route('documents.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-xl font-semibold text-pam-blue mb-6">Required Legal Documents</h2>
                    
                    <!-- Document Requirements -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-pam-blue mb-3">Documents Needed</h3>
                        <p class="text-pam-gray mb-4">Please upload clear, high-quality scans or photos of the following documents. All documents must be valid and not expired.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Document Type 1 - Government ID (All roles) -->
                            <div class="document-card bg-pam-gray-light rounded-lg p-4 border border-pam-gray-light">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-pam-blue/10 p-2 rounded-lg">
                                        <i class="fas fa-id-card text-pam-blue text-lg"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-pam-blue">Government ID</h4>
                                        <p class="text-sm text-pam-gray mt-1">National ID, Driver's License, or International Passport</p>
                                        <p class="text-xs text-pam-red mt-1">Required</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Document Type 2 - Proof of Address (All roles) -->
                            <div class="document-card bg-pam-gray-light rounded-lg p-4 border border-pam-gray-light">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-pam-blue/10 p-2 rounded-lg">
                                        <i class="fas fa-file-contract text-pam-blue text-lg"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-pam-blue">Proof of Address</h4>
                                        <p class="text-sm text-pam-gray mt-1">Utility bill or bank statement (not older than 3 months)</p>
                                        <p class="text-xs text-pam-red mt-1">Required</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Document Type 3 - Insurance Certificate (Conditional) -->
                            <div id="insurance-card" class="document-card bg-pam-gray-light rounded-lg p-4 border border-pam-gray-light hidden">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-pam-blue/10 p-2 rounded-lg">
                                        <i class="fas fa-shield-alt text-pam-blue text-lg"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-pam-blue">Insurance Certificate</h4>
                                        <p class="text-sm text-pam-gray mt-1">Valid insurance coverage document</p>
                                        <p id="insurance-requirement" class="text-xs text-pam-green mt-1">Optional</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Document Type 4 - Business License (Vendors) -->
                            <div id="business-license-card" class="document-card bg-pam-gray-light rounded-lg p-4 border border-pam-gray-light hidden">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-pam-blue/10 p-2 rounded-lg">
                                        <i class="fas fa-briefcase text-pam-blue text-lg"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-pam-blue">Business License</h4>
                                        <p class="text-sm text-pam-gray mt-1">For vendors and business operators</p>
                                        <p class="text-xs text-pam-red mt-1">Required for vendors</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Document Type 5 - Vehicle Registration (Riders) -->
                            <div id="vehicle-registration-card" class="document-card bg-pam-gray-light rounded-lg p-4 border border-pam-gray-light hidden">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-pam-blue/10 p-2 rounded-lg">
                                        <i class="fas fa-car text-pam-blue text-lg"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-pam-blue">Vehicle Registration</h4>
                                        <p class="text-sm text-pam-gray mt-1">For riders and delivery personnel</p>
                                        <p class="text-xs text-pam-red mt-1">Required for riders</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Document Type 6 - Professional Certification (Optional) -->
                            <div id="professional-cert-card" class="document-card bg-pam-gray-light rounded-lg p-4 border border-pam-gray-light hidden">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-pam-blue/10 p-2 rounded-lg">
                                        <i class="fas fa-certificate text-pam-blue text-lg"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-pam-blue">Professional Certification</h4>
                                        <p class="text-sm text-pam-gray mt-1">Any relevant professional licenses</p>
                                        <p class="text-xs text-pam-green mt-1">Optional</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Upload Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-pam-blue mb-3">Upload Documents</h3>
                        <p class="text-pam-gray mb-4">Upload files in PDF, JPG, or PNG format (Max 5MB each)</p>
                        
                        <div class="space-y-6">
                            <!-- Government ID Upload (All roles) -->
                            <div>
                                <label class="block text-sm font-medium text-pam-gray mb-1">Government ID <span class="text-pam-red">*</span></label>
                                <div class="mt-1">
                                    <label for="government-id" class="file-input-label flex flex-col items-center justify-center px-6 py-10 border-2 border-dashed rounded-lg cursor-pointer text-center">
                                        <div class="flex items-center">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-pam-blue mr-2"></i>
                                            <span class="text-pam-blue font-medium">Click to upload</span>
                                        </div>
                                        <p class="mt-1 text-xs text-pam-gray">or drag and drop</p>
                                        <p class="mt-1 text-xs text-pam-gray">PDF, JPG, PNG up to 5MB</p>
                                        <input id="government-id" name="government_id" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </label>
                                </div>
                                <div id="government-id-preview" class="mt-2 hidden">
                                    <!-- Preview will appear here -->
                                </div>
                            </div>
                            
                            <!-- Proof of Address Upload (All roles) -->
                            <div>
                                <label class="block text-sm font-medium text-pam-gray mb-1">Proof of Address <span class="text-pam-red">*</span></label>
                                <div class="mt-1">
                                    <label for="proof-address" class="file-input-label flex flex-col items-center justify-center px-6 py-10 border-2 border-dashed rounded-lg cursor-pointer text-center">
                                        <div class="flex items-center">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-pam-blue mr-2"></i>
                                            <span class="text-pam-blue font-medium">Click to upload</span>
                                        </div>
                                        <p class="mt-1 text-xs text-pam-gray">or drag and drop</p>
                                        <p class="mt-1 text-xs text-pam-gray">PDF, JPG, PNG up to 5MB</p>
                                        <input id="proof-address" name="proof_of_address" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </label>
                                </div>
                                <div id="proof-address-preview" class="mt-2 hidden">
                                    <!-- Preview will appear here -->
                                </div>
                            </div>
                            
                            <!-- Vehicle Registration Upload (Riders only) -->
                            <div id="vehicle-registration-section" class="hidden">
                                <label class="block text-sm font-medium text-pam-gray mb-1">Vehicle Registration <span class="text-pam-red">*</span></label>
                                <div class="mt-1">
                                    <label for="vehicle-registration" class="file-input-label flex flex-col items-center justify-center px-6 py-10 border-2 border-dashed rounded-lg cursor-pointer text-center">
                                        <div class="flex items-center">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-pam-blue mr-2"></i>
                                            <span class="text-pam-blue font-medium">Click to upload</span>
                                        </div>
                                        <p class="mt-1 text-xs text-pam-gray">or drag and drop</p>
                                        <p class="mt-1 text-xs text-pam-gray">PDF, JPG, PNG up to 5MB</p>
                                        <input id="vehicle-registration" name="vehicle_registration" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                                    </label>
                                </div>
                                <div id="vehicle-registration-preview" class="mt-2 hidden">
                                    <!-- Preview will appear here -->
                                </div>
                            </div>
                            
                            <!-- Business License Upload (Vendors only) -->
                            <div id="business-license-section" class="hidden">
                                <label class="block text-sm font-medium text-pam-gray mb-1">Business License <span class="text-pam-red">*</span></label>
                                <div class="mt-1">
                                    <label for="business-license" class="file-input-label flex flex-col items-center justify-center px-6 py-10 border-2 border-dashed rounded-lg cursor-pointer text-center">
                                        <div class="flex items-center">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-pam-blue mr-2"></i>
                                            <span class="text-pam-blue font-medium">Click to upload</span>
                                        </div>
                                        <p class="mt-1 text-xs text-pam-gray">or drag and drop</p>
                                        <p class="mt-1 text-xs text-pam-gray">PDF, JPG, PNG up to 5MB</p>
                                        <input id="business-license" name="business_license" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                                    </label>
                                </div>
                                <div id="business-license-preview" class="mt-2 hidden">
                                    <!-- Preview will appear here -->
                                </div>
                            </div>
                            
                            <!-- Insurance Certificate Upload (Conditional) -->
                            <div id="insurance-certificate-section" class="hidden">
                                <label class="block text-sm font-medium text-pam-gray mb-1">Insurance Certificate</label>
                                <div class="mt-1">
                                    <label for="insurance-certificate" class="file-input-label flex flex-col items-center justify-center px-6 py-10 border-2 border-dashed rounded-lg cursor-pointer text-center">
                                        <div class="flex items-center">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-pam-blue mr-2"></i>
                                            <span class="text-pam-blue font-medium">Click to upload</span>
                                        </div>
                                        <p class="mt-1 text-xs text-pam-gray">or drag and drop</p>
                                        <p class="mt-1 text-xs text-pam-gray">PDF, JPG, PNG up to 5MB</p>
                                        <input id="insurance-certificate" name="insurance_certificate" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                                    </label>
                                </div>
                                <div id="insurance-certificate-preview" class="mt-2 hidden">
                                    <!-- Preview will appear here -->
                                </div>
                            </div>
                            
                            <!-- Additional Documents (All roles) -->
                            <div>
                                <label class="block text-sm font-medium text-pam-gray mb-1">Additional Documents</label>
                                <div class="mt-1">
                                    <label for="additional-docs" class="file-input-label flex flex-col items-center justify-center px-6 py-10 border-2 border-dashed rounded-lg cursor-pointer text-center">
                                        <div class="flex items-center">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-pam-blue mr-2"></i>
                                            <span class="text-pam-blue font-medium">Click to upload</span>
                                        </div>
                                        <p class="mt-1 text-xs text-pam-gray">or drag and drop</p>
                                        <p class="mt-1 text-xs text-pam-gray">PDF, JPG, PNG up to 5MB</p>
                                        <input id="additional-docs" name="additional_documents[]" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png" multiple>
                                    </label>
                                </div>
                                <div id="additional-docs-preview" class="mt-2 hidden">
                                    <!-- Preview will appear here -->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Terms and Conditions -->
                    <div class="mb-8">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox" class="focus:ring-pam-blue h-4 w-4 text-pam-blue border-pam-gray-light rounded" required>
                            </div>
                            <div class="ml-3">
                                <label for="terms" class="text-sm text-pam-gray">
                                    I certify that all documents submitted are valid, unaltered, and belong to me. I understand that providing false information may result in account termination.
                                    <span class="text-pam-red">*</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex items-start mt-4">
                            <div class="flex items-center h-5">
                                <input id="privacy" name="privacy" type="checkbox" class="focus:ring-pam-blue h-4 w-4 text-pam-blue border-pam-gray-light rounded" required>
                            </div>
                            <div class="ml-3">
                                <label for="privacy" class="text-sm text-pam-gray">
                                    I agree to the <a href="#" class="text-pam-blue hover:underline">Privacy Policy</a> and <a href="#" class="text-pam-blue hover:underline">Terms of Service</a>.
                                    <span class="text-pam-red">*</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submission Buttons -->
                    <div class="flex justify-between pt-4 border-t border-pam-gray-light">
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-gray bg-white hover:bg-pam-gray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pam-blue hover:bg-pam-blue-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue">
                            Submit Documents
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-pam-gray-light mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-pam-gray text-sm">
                <p>© 2023 PAM Logistics. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get user role from the badge
            const roleBadge = document.getElementById('role-badge');
            const userRole = roleBadge.textContent.trim().toLowerCase();
            
            // Show/hide sections based on role
            function toggleSectionsByRole() {
                // Common elements for all roles
                const commonSections = [
                    'government-id',
                    'proof-address',
                    'additional-docs'
                ];
                
                // Role-specific elements
                const riderSections = ['vehicle-registration-section', 'insurance-certificate-section'];
                const vendorSections = ['business-license-section', 'insurance-certificate-section'];
                const operatorSections = ['insurance-certificate-section'];
                
                // Show common sections
                commonSections.forEach(id => {
                    const element = document.getElementById(id);
                    if (element) element.required = true;
                });
                
                // Handle role-specific sections
                if (userRole === 'rider') {
                    riderSections.forEach(id => {
                        const element = document.getElementById(id);
                        if (element) {
                            element.classList.remove('hidden');
                            if (id === 'vehicle-registration-section') {
                                document.getElementById('vehicle-registration').required = true;
                            }
                        }
                    });
                    document.getElementById('vehicle-registration-card').classList.remove('hidden');
                    document.getElementById('insurance-card').classList.remove('hidden');
                    document.getElementById('insurance-requirement').textContent = 'Required for riders';
                    document.getElementById('insurance-requirement').classList.replace('text-pam-green', 'text-pam-red');
                } 
                else if (userRole === 'vendor') {
                    vendorSections.forEach(id => {
                        const element = document.getElementById(id);
                        if (element) {
                            element.classList.remove('hidden');
                            if (id === 'business-license-section') {
                                document.getElementById('business-license').required = true;
                            }
                        }
                    });
                    document.getElementById('business-license-card').classList.remove('hidden');
                    document.getElementById('insurance-card').classList.remove('hidden');
                } 
                else if (userRole === 'operator') {
                    operatorSections.forEach(id => {
                        const element = document.getElementById(id);
                        if (element) element.classList.remove('hidden');
                    });
                    document.getElementById('insurance-card').classList.remove('hidden');
                }
                
                // Always show professional certification (optional for all)
                document.getElementById('professional-cert-card').classList.remove('hidden');
            }
            
            // Initialize role-based sections
            toggleSectionsByRole();
            
            // Handle file upload previews
            function setupFileInput(inputId, previewId) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                
                if (input && preview) {
                    input.addEventListener('change', function(e) {
                        if (this.files && this.files[0]) {
                            const fileName = this.files[0].name;
                            const fileType = fileName.split('.').pop().toLowerCase();
                            
                            let iconClass = 'fa-file';
                            if (fileType === 'pdf') iconClass = 'fa-file-pdf text-pam-red';
                            if (['jpg', 'jpeg', 'png'].includes(fileType)) iconClass = 'fa-file-image text-pam-blue';
                            
                            preview.innerHTML = `
                                <div class="flex items-center justify-between bg-pam-gray-light p-2 rounded">
                                    <div class="flex items-center">
                                        <i class="fas ${iconClass} mr-2"></i>
                                        <span class="text-sm">${fileName}</span>
                                    </div>
                                    <button type="button" class="text-pam-red hover:text-pam-red-dark" onclick="document.getElementById('${inputId}').value = ''; this.parentNode.remove();">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `;
                            preview.classList.remove('hidden');
                        }
                    });
                }
            }
            
            // Setup all file inputs
            setupFileInput('government-id', 'government-id-preview');
            setupFileInput('proof-address', 'proof-address-preview');
            setupFileInput('vehicle-registration', 'vehicle-registration-preview');
            setupFileInput('business-license', 'business-license-preview');
            setupFileInput('insurance-certificate', 'insurance-certificate-preview');
            
            // Handle multiple file uploads for additional docs
            const additionalDocsInput = document.getElementById('additional-docs');
            const additionalDocsPreview = document.getElementById('additional-docs-preview');
            
            if (additionalDocsInput && additionalDocsPreview) {
                additionalDocsInput.addEventListener('change', function(e) {
                    if (this.files && this.files.length > 0) {
                        additionalDocsPreview.innerHTML = '';
                        
                        Array.from(this.files).forEach(file => {
                            const fileName = file.name;
                            const fileType = fileName.split('.').pop().toLowerCase();
                            
                            let iconClass = 'fa-file';
                            if (fileType === 'pdf') iconClass = 'fa-file-pdf text-pam-red';
                            if (['jpg', 'jpeg', 'png'].includes(fileType)) iconClass = 'fa-file-image text-pam-blue';
                            
                            const fileElement = document.createElement('div');
                            fileElement.className = 'flex items-center justify-between bg-pam-gray-light p-2 rounded mb-2';
                            fileElement.innerHTML = `
                                <div class="flex items-center">
                                    <i class="fas ${iconClass} mr-2"></i>
                                    <span class="text-sm">${fileName}</span>
                                </div>
                                <button type="button" class="text-pam-red hover:text-pam-red-dark">
                                    <i class="fas fa-times"></i>
                                </button>
                            `;
                            
                            // Add remove functionality
                            fileElement.querySelector('button').addEventListener('click', function() {
                                // Create a new DataTransfer to remove the file
                                const dataTransfer = new DataTransfer();
                                Array.from(additionalDocsInput.files).forEach(f => {
                                    if (f.name !== fileName) dataTransfer.items.add(f);
                                });
                                additionalDocsInput.files = dataTransfer.files;
                                
                                // Remove the preview element
                                fileElement.remove();
                                
                                // Hide preview container if no files left
                                if (additionalDocsInput.files.length === 0) {
                                    additionalDocsPreview.classList.add('hidden');
                                }
                            });
                            
                            additionalDocsPreview.appendChild(fileElement);
                        });
                        
                        additionalDocsPreview.classList.remove('hidden');
                    }
                });
            }
            
            // Handle drag and drop
            const fileInputLabels = document.querySelectorAll('.file-input-label');
            
            fileInputLabels.forEach(label => {
                label.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('dragover');
                });
                
                label.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');
                });
                
                label.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');
                    
                    const input = this.querySelector('input[type="file"]');
                    if (input) {
                        input.files = e.dataTransfer.files;
                        const event = new Event('change');
                        input.dispatchEvent(event);
                    }
                });
            });
            
            // Form validation
            const form = document.getElementById('document-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Validate required fields
                    let isValid = true;
                    const requiredInputs = form.querySelectorAll('[required]');
                    
                    requiredInputs.forEach(input => {
                        if (input.type === 'checkbox' && !input.checked) {
                            input.closest('.flex.items-start').classList.add('border-pam-red', 'border-2', 'p-2', 'rounded');
                            isValid = false;
                        } else if (input.type === 'file' && !input.files.length) {
                            input.closest('.mt-1').classList.add('border-pam-red', 'border-2');
                            isValid = false;
                        } else {
                            if (input.type === 'checkbox') {
                                input.closest('.flex.items-start').classList.remove('border-pam-red', 'border-2', 'p-2', 'rounded');
                            } else {
                                input.closest('.mt-1').classList.remove('border-pam-red', 'border-2');
                            }
                        }
                    });
                    
                    if (!isValid) {
                        e.preventDefault();
                        alert('Please fill all required fields');
                        return;
                    }
                    
                    // If validation passes, the form will submit normally
                });
            }
        });
    </script>
</body>
</html>