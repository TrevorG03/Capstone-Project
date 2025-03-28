<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the registration page

    public function welcome()
    {
        return view('welcome');
    }
    public function register()
    {
        return view("auth.register");
    }

    // Handle user registration
    public function registerUser(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8|max:12',
        ]);

        // Create a new user instance
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password); // Ensure password is hashed

        // Save the user and handle response
        if ($user->save()) {
            return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
        } else {
            return redirect()->back()->with('fail', 'Registration failed. Please try again.');
        }
    }

    // Show the login page
    public function login()
    {
        // Check if the user is already logged in
        if (Session::has('loginId')) {
            return redirect()->route('dashboard');
        }

        return view("auth.login");
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
    
        $user = User::where('username', $request->username)->first();
    
        if (!$user) {
            return back()->with('fail', 'User not found.');
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('fail', 'Incorrect password.');
        }
    
        Session::put('loginId', $user->ID);
        
        // Debug session after auth
        \Log::info('Post-Auth Session: ', session()->all());
        
        return redirect()->route('dashboard');
    }
    // Display the dashboard
    public function dashboard()
    {
        if (Session::has('loginId')) {
            $data = User::find(Session::get('loginId'));
            return view('dashboard', compact('data'));
        }
        return redirect()->route('login')->with('fail', 'Please log in first.');
    }


public function logout(Request $request)
{
    // Log the user out
    Auth::logout();

    // Invalidate the session
    $request->session()->invalidate();

    // Regenerate the CSRF token
    $request->session()->regenerateToken();

    // Redirect to the login page
    return redirect()->route('login');
}

}
