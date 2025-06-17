<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            // 'role' => 'required|in:admin,vendor,operator,rider',
        ]);
        // dd($request->all());
        $credentials = $request->only('email', 'password');
        // $credentials['role'] = $request->input('role');
        // dd($request->all());
        // Attempt to log the user in with role
        if (auth()->attempt($credentials, $request->has('remember-me'))) {
            if(auth()->user()->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }
            if(auth()->user()->role == 'vendor'){
                return redirect()->route('vendor.dashboard');
            }
            if(auth()->user()->role == 'operator'){
                return redirect()->route('operator.dashboard');
            }
            if(auth()->user()->role == 'rider'){
                return redirect()->route('rider.dashboard');
            }
            // Redirect based on user role

            
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }
}
