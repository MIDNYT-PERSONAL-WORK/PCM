<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\LogController;

class AuthController extends Controller
{
    //
    
    public function welcome()
    {
        $products = Product::all(); // Example usage of Product model, can be removed if not needed
        return view('guest.welcome', compact('products'));
    }
    
    
    
    public function login(Request $request)
{
    // Validate the request data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    $credentials = $request->only('email', 'password');

    // Attempt to log the user in
    if (auth()->attempt($credentials, $request->has('remember-me'))) {
        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id;
        $userEmail = $user->email;

        if ($user->role == 'admin') {
            LogController::log(
                'User login Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->route('admin.dashboard');
        }

        if ($user->role == 'vendor') {
            // Handle document rejection checks
            $documents = $user->documents;
            
            // Check if any document is rejected
            if ($documents) {
                $rejectedFields = [
                    'status_government_id' => 'government_id',
                    'status_proof_of_address' => 'proof_of_address',
                    'status_vehicle_registration' => 'vehicle_registration',
                    'status_business_license' => 'business_license',
                    'status_insurance_certificate' => 'insurance_certificate'
                ];
                
                $requiredFields = [];
                $rejectionComments = null;

                // Handle both collection and single document cases
                $documentsToCheck = $documents instanceof \Illuminate\Support\Collection 
                    ? $documents 
                    : collect([$documents]);

                foreach ($documentsToCheck as $doc) {
                    // Check individual document fields
                    foreach ($rejectedFields as $statusField => $documentType) {
                        if (isset($doc->$statusField) && $doc->$statusField === 'rejected') {
                            $requiredFields[] = $documentType;
                            $rejectionComments = $doc->comments ?? 'Document rejected';
                        }
                    }
                    
                    // Check overall document status
                    if (isset($doc->status) && $doc->status === 'rejected') {
                        $requiredFields = array_values($rejectedFields);
                        $rejectionComments = $doc->comments ?? 'Document rejected';
                        break; // No need to check further if overall status is rejected
                    }
                }

                // Redirect if any rejections found
                if (!empty($requiredFields)) {
                    return redirect()->route('auth.document', [
                        'required_fields' => array_unique($requiredFields)
                    ])->with('error', $rejectionComments ?: 'Some documents were rejected');
                }
            }

            // Handle account status checks
            if ($user->is_active == 'unassigned') {
                return redirect()->route('auth.document');
            }

            if ($user->is_active == 'pending') {
                return redirect()->back()->with('error', 'Your account is pending approval. Please wait for admin approval.');
            }

            // Log successful login
            LogController::log(
                'User login Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );

            return redirect()->route('vendor.dashboard');
        }

        if ($user->role == 'operator') {
            if ($user->is_active == 'unassigned') {
                return redirect()->route('auth.document');
            }
            
            $documents = $user->documents;
            if ($documents) {
                $rejectedFields = [
                    'status_government_id',
                    'status_proof_of_address',
                    'status_vehicle_registration',
                    'status_business_license',
                    'status_insurance_certificate'
                ];
                $typeMapping = [
                    'status_government_id' => 'government_id',
                    'status_proof_of_address' => 'proof_of_address',
                    'status_vehicle_registration' => 'vehicle_registration',
                    'status_business_license' => 'business_license',
                    'status_insurance_certificate' => 'insurance_certificate'
                ];
                
                // If $documents is a collection, loop through each document
                if ($documents instanceof \Illuminate\Support\Collection) {
                    foreach ($documents as $doc) {
                        foreach ($rejectedFields as $field) {
                            if (isset($doc->$field) && $doc->$field === 'rejected') {
                                $documentType = $typeMapping[$field] ?? null;
                                $requiredFields = [];
                                if ($documentType && isset($typeMapping[$documentType])) {
                                    $requiredFields[] = $documentType;
                                } else {
                                    $requiredFields = array_keys($typeMapping);
                                }
                                return redirect()->route('auth.document', ['required_fields' => $requiredFields])
                                    ->with('error', 'Document rejected. Please upload the required documents.');
                            }
                        }
                        if (isset($doc->status) && $doc->status === 'rejected') {
                            $requiredFields = array_keys($typeMapping);
                            return redirect()->route('auth.document', ['required_fields' => $requiredFields])
                                ->with('error', 'Document rejected. Please upload the required documents.');
                        }
                    }
                } else {
                    // If $documents is a single model
                    foreach ($rejectedFields as $field) {
                        if (isset($documents->$field) && $documents->$field === 'rejected') {
                            $documentType = $typeMapping[$field] ?? null;
                            $requiredFields = [];
                            if ($documentType && isset($typeMapping[$documentType])) {
                                $requiredFields[] = $documentType;
                            } else {
                                $requiredFields = array_keys($typeMapping);
                            }
                            return redirect()->route('auth.document', ['required_fields' => $requiredFields])
                                ->with('error', 'Document rejected. Please upload the required documents.');
                        }
                    }
                    if (isset($documents->status) && $documents->status === 'rejected') {
                        $requiredFields = array_keys($typeMapping);
                        return redirect()->route('auth.document', ['required_fields' => $requiredFields])
                            ->with('error', 'Document rejected. Please upload the required documents.');
                    }
                }
            }

            if ($user->is_active == 'pending') {
                return redirect()->back()->with('error', 'Your account is pending approval. Please wait for admin approval.');
            } 
            
            LogController::log(
                'User login Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->route('operator.dashboard');
        }

        if ($user->role == 'rider') {
            if ($user->is_active == 'unassigned') {
                return redirect()->route('auth.document');
            }
            if ($user->is_active == 'pending') {
                return redirect()->back()->with('error', 'Your account is pending approval. Please wait for admin approval.');
            }
            
            LogController::log(
                'User login Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->route('rider.dashboard');
        }

        return redirect()->route('profile')->with('success', 'Login successful');
    }

    return redirect()->back()->with('error', 'Invalid credentials');
}

    public function logout()
    {
        //dd('hello');
        // Get user info before logout
        $user = auth()->user();
        $userId = auth()->id();
        $userEmail = $user ? $user->email : null;

        // Log out the authenticated user
        auth()->logout();

        // Invalidate the session and regenerate CSRF token
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        LogController::log(
            'User logged out',
            'success',
            ['email' => $userEmail],
            $userId,
            request()->ip()
        );
        // Redirect to login/signup page with a success message
        return redirect()->route('LoginSignup')->with('success', 'You have been logged out successfully.');
    }

     public function PasswordUpdate(Request $request)
        {
            $request->validate([
                'current_password' => 'required|min:6',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = auth()->user();
            $userId = auth()->id();
            $userEmail = $user ? $user->email : null;

            // Check if current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            // Update the password
            $user->password = Hash::make($request->password);
            $user->save();

            // Redirect based on role
            $role = $user->role;

            if ($role === 'admin') {
                 LogController::log(
                'User password updated Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
        
            return redirect()->route('admin.dashboard')->with('success', 'Password updated successfully.');
            
        } 
        elseif ($role === 'vendor') {
             LogController::log(
                'User password updated Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->route('vendor.dashboard')->with('success', 'Password updated successfully.');
        } 

        elseif ($role === 'operator') {
             LogController::log(
                'User password updated Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->route('operator.dashboard')->with('success', 'Password updated successfully.');
        } elseif ($role === 'rider') {
             LogController::log(
                'User password updated Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->route('rider.dashboard')->with('success', 'Password updated successfully.');
        }
        else {
             LogController::log(
                'User password updated Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->back()->with('success', 'Password updated successfully.');
        }
        }

    public function UpdateProfile(Request $request){
        
        $request->validate([
            // 'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/^(\+?[0-9]{1,4})?[0-9]{9,14}$/',
            // 'address'=> 'required|string|max:255',
         ]);
        
        $user = Auth::user();
        // $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        // $user->address=$request->address;
        $user->save();
        $role = $user->role;
        $userId = auth()->id();
        $userEmail = $user ? $user->email : null;

        if ($role === 'admin') {
             LogController::log(
                'User Profile updated Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully.');
        } elseif ($role === 'vendor') {
            LogController::log(
                'User Profile updated Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->route('vendor.dashboard')->with('success', 'Profile updated successfully.');
        } 
        elseif ($role === 'operator') {
            LogController::log(
                'User Profile updated Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->route('operator.dashboard')->with('success', 'Profile updated successfully.');
        } elseif ($role === 'rider') {
            LogController::log(
                'User Profile updated Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->route('rider.dashboard')->with('success', 'Profile updated successfully.');
        }
        else {
            LogController::log(
                'User Profile updated Successful',
                'success',
                ['email' => $userEmail],
                $userId,
                request()->ip()
            );
            return redirect()->back()->with('success', 'Profile updated successfully.');
        }

    } 
    
    public function ChangeAvatar(Request $request)
    {
        dd($request);
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        // Delete old avatar if it exists
        if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
            unlink(storage_path('app/public/' . $user->avatar));
        }

        // Store new avatar
        $path = $request->file('avatar')->store('avatars', 'public');

        // Update user avatar
        $user->avatar = $path;
        $user->save();

        $role = $user->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully.');
        } elseif ($role === 'vendor') {
            return redirect()->route('vendor.dashboard')->with('success', 'Profile updated successfully.');
        } 
        elseif ($role === 'operator') {
            return redirect()->route('operator.dashboard')->with('success', 'Profile updated successfully.');
        } elseif ($role === 'rider') {
            return redirect()->route('rider.dashboard')->with('success', 'Profile updated successfully.');
        }
        else {
            return redirect()->back()->with('success', 'Profile updated successfully.');
        }


    }

    

    public function AddUser(Request $request)
{
    // dd($request->all());
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|regex:/^(\+?[0-9]{1,4})?[0-9]{9,14}$/',
        'password' => 'required|string|min:8',
        'role' => 'required|in:vendor,operator,rider,Unassigned',
        'company_name' => 'required|string|max:255',
        'address' => 'required|string',
    ]);
    // dd($validated);
    try {
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'is_active' => 'unassigned', // Changed from 'unassigned'
        ]);

        
        if('role'==='vendor'){
            Vendor::create([
            'user_id' => $user->id,
            'company_name' => $validated['company_name'],
            'address' => $validated['address'],
        ]);
        }
        

        return redirect()->back()->with('success', 'User added successfully.');
        
    } catch (\Exception $e) {
        return redirect()->back()
               ->with('error', 'Error creating user: '.$e->getMessage())
               ->withInput();
    }
}

}
