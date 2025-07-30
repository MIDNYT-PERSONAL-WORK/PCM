<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RolesController extends Controller
{
    public function RolePage()
    {
        $users = User::where('role', '!=', 'admin')->paginate(10);
        return view('admin.role', compact('users'));
    }

 public function DocumentPage(Request $request)
{
    $user = auth()->user();
    
    // Get the single document record
    $document = $user->document;
    
    // Validation rules
    $validationRules = [
        'terms' => 'required|accepted',
        'privacy' => 'required|accepted'
    ];
    
    // Add validation for required documents based on role and rejection status
    if ($user->role === 'rider') {
        $validationRules['vehicle_registration'] = ($document && $document->status_vehicle_registration === 'rejected') 
            ? 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
            : 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
    }
    
    if ($user->role === 'vendor') {
        $validationRules['business_license'] = ($document && $document->status_business_license === 'rejected') 
            ? 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
            : 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
    }
    
    // Always require government ID and proof of address unless already approved
    $validationRules['government_id'] = (!$document || $document->status_government_id === 'rejected')
        ? 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
        : 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
        
    $validationRules['proof_of_address'] = (!$document || $document->status_proof_of_address === 'rejected')
        ? 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
        : 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
        
    $validationRules['insurance_certificate'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
    $validationRules['additional_documents.*'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';

    $validated = $request->validate($validationRules);

    $paths = [];
    $fileFields = [
        'government_id',
        'proof_of_address',
        'vehicle_registration',
        'business_license',
        'insurance_certificate'
    ];

    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            $paths[$field] = $request->file($field)->store('documents', 'private');
        }
    }

    if ($request->hasFile('additional_documents')) {
        foreach ($request->file('additional_documents') as $file) {
            $paths['additional_documents'][] = $file->store('documents', 'private');
        }
    }

    $documentData = [
        'user_id' => $user->id,
        'terms' => 1,
        'privacy' => 1,
    ];

    // Only update fields that were submitted or are required
    foreach ($fileFields as $field) {
        if (isset($paths[$field])) {
            $documentData[$field] = $paths[$field];
            // Reset status for re-uploaded documents
            $documentData['status_'.$field] = 'pending';
        } elseif ($document && $document->$field) {
            // Keep existing value if not re-uploaded
            $documentData[$field] = $document->$field;
        }
    }

    if (isset($paths['additional_documents'])) {
        $documentData['additional_documents'] = json_encode($paths['additional_documents']);
    } elseif ($document && $document->additional_documents) {
        $documentData['additional_documents'] = $document->additional_documents;
    }

    if ($document) {
        // Update existing record
        $document->update($documentData);
    } else {
        // Create new record
        Documents::create($documentData);
    }

    $user->update(['is_active' => 'pending']);

    return redirect('auth')->with('success', 'Documents submitted successfully.');
}

    public function show(User $user)
    {
        $documents = Documents::where('user_id', $user->id)->with('user')->paginate(10);
        return view('admin.documentApprove', compact('user', 'documents'));
    }

    public function DocumentShow(Documents $document)
    {
        $document->load('user');
        
        return response()->json([
            'user' => [
                'name' => $document->user->name,
                'email' => $document->user->email,
                'phone' => $document->user->phone,
                'role' => $document->user->role
            ],
            'government_id' => $document->government_id,
            'status_government_id' => $document->status_government_id,
            'proof_of_address' => $document->proof_of_address,
            'status_proof_of_address' => $document->status_proof_of_address,
            'vehicle_registration' => $document->vehicle_registration,
            'status_vehicle_registration' => $document->status_vehicle_registration,
            'business_license' => $document->business_license,
            'status_business_license' => $document->status_business_license,
            'insurance_certificate' => $document->insurance_certificate,
            'status_insurance_certificate' => $document->status_insurance_certificate,
            'created_at' => $document->created_at,
            'updated_at' => $document->updated_at
        ]);
    }

    public function downloadDocument($filename)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Forbidden: Only admins can access this file.');
        }

        $filePath = 'documents/' . $filename;

        if (!Storage::disk('private')->exists($filePath)) {
            abort(404, 'File not found.');
        }

        $mime = Storage::disk('private')->mimeType($filePath);
        
        return response()->file(storage_path('app/private/' . $filePath), [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="'.$filename.'"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
            'Pragma' => 'no-cache'
        ]);
    }

    // Add these methods if they don't exist
    // In your RolesController.php

public function approveDocument($documentId, Request $request)
{
    DB::beginTransaction();
    try {
        $document = Documents::with('user')->findOrFail($documentId);
        $documentType = $request->input('document_type');

        // Document type mapping
        $typeMapping = [
            'government_id' => 'status_government_id',
            'proof_of_address' => 'status_proof_of_address',
            'vehicle_registration' => 'status_vehicle_registration',
            'business_license' => 'status_business_license',
            'insurance_certificate' => 'status_insurance_certificate'
        ];

        if ($documentType && $documentType !== 'all') {
            // Normalize document type (handle both "Government ID" and "government_id")
            $normalizedType = strtolower(str_replace(' ', '_', $documentType));
            $statusField = $typeMapping[$normalizedType] ?? null;

            if ($statusField && in_array($statusField, array_values($typeMapping))) {
                $document->$statusField = 'approved';
                $document->save();
            }
        } else {
            // Approve all documents
            foreach ($typeMapping as $statusField) {
                $document->$statusField = 'approved';
            }
            $document->save();
        }

        // Refresh document to get latest changes
        $document->refresh();
        // if ($document->status_government_id=="approved" && $document->status_proof_of_address=="approved" &&
        // $document->status_proof_of_address=="approved"  )
        // Check if all documents are approved
        $allApproved = collect($typeMapping)->every(function ($statusField) use ($document) {
            return $document->$statusField === 'approved';
        });
        Log::info('User activated', [
                    'allApproved' =>  $allApproved,
                    'document_id' => $documentId
                ]);

        // Activate user if needed && $allApproved
        if ($document->user ) {
            $user = $document->user;
            if ($user->is_active === 'pending') {
                $user->is_active = 'active';
                $user->save();
                
                Log::info('User activated', [
                    'user_id' => $user->id,
                    'document_id' => $documentId
                ]);
            }
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Document approved successfully',
            'all_approved' => $allApproved,
            'user_activated' => $allApproved && isset($user) && $user->wasChanged('is_active')
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Document approval failed', [
            'error' => $e->getMessage(),
            'document_id' => $documentId
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Approval failed: ' . $e->getMessage()
        ], 500);
    }
}

public function rejectDocument($documentId, Request $request)
{
    $document = Documents::findOrFail($documentId);
    $documentType = $request->input('document_type');
    $reason = $request->input('reason');
    $details = $request->input('details');

    // Document type mapping
    $typeMapping = [
        'government_id' => 'status_government_id',
        'proof_of_address' => 'status_proof_of_address',
        'vehicle_registration' => 'status_vehicle_registration',
        'business_license' => 'status_business_license',
        'insurance_certificate' => 'status_insurance_certificate'
    ];

    // Prepare rejection comment
    $comment = "Rejected";
    if ($documentType && isset($typeMapping[$documentType])) {
        $comment .= " ($documentType)";
    }
    if ($reason) {
        $comment .= ": $reason";
    }
    if ($details) {
        $comment .= " - $details";
    }

    // Update comments field
    if ($document->comments) {
        $document->comments .= "\n" . $comment;
    } else {
        $document->comments = $comment;
    }

    if ($documentType && isset($typeMapping[$documentType])) {
        $statusField = $typeMapping[$documentType];
        $document->$statusField = 'rejected';
    } else {
        // If no specific type, mark all as rejected
        foreach ($typeMapping as $statusField) {
            $document->$statusField = 'rejected';
        }
    }
    $document->save();

    return response()->json([
        'success' => true,
        'message' => 'Document rejected successfully.'
    ]);
}
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Add your update logic here
    }

    public function destroy(User $user)
    {
        // Add your delete logic here
    }
}