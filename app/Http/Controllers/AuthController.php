<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Handle Clinician Registration
     */
    public function registerSubmit(Request $request)
    {
        // 1. Validate the registration data[cite: 2]
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.min' => 'Your password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'email.unique' => 'This email is already registered.'
        ]);

        // 2. Use a transaction to ensure data integrity across tables[cite: 2]
        DB::transaction(function () use ($request) {
            $userId = DB::table('users')->insertGetId([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'password_hash' => Hash::make($request->password),
                'role' => 'clinician',
                'account_status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('clinic_personnel')->insert([
                'user_id' => $userId,
                'full_name' => $request->full_name,
                'role_title' => 'Staff',
                'access_level' => 'standard',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        // 3. Flash a success message and redirect to login[cite: 2]
        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }

    /**
     * Handle Clinician Login
     */
    public function loginSubmit(Request $request)
    {
        // 1. Basic validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Fetch the user manually to handle the 'password_hash' column[cite: 2]
        $user = DB::table('users')->where('email', $request->email)->first();

        // 3. Verify existence and verify hashed password[cite: 2]
        if ($user && Hash::check($request->password, $user->password_hash)) {
            // Log in using the specific custom primary key 'user_id'[cite: 2]
            Auth::loginUsingId($user->user_id);
            
            // Regenerate session to prevent session fixation attacks[cite: 2]
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // 4. If authentication fails, redirect back with error and keep the email input[cite: 2]
        return back()->withErrors([
            'login_error' => 'The email or password you entered is incorrect.',
        ])->withInput($request->only('email')); 
    }

    /**
     * Handle Clinician Logout
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken(); // Refreshes CSRF token for security[cite: 2]
        
        return redirect('/login');
    }
}