<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the welcome page
    public function welcome()
    {
        return view('welcome');
    }
    
    // Show the registration page
    public function register()
    {
        return view("auth.register");
    }

    // Handle user registration
    public function registerUser(Request $request)
    {
        // Validate the request, including the email field
        $request->validate([
            'name'     => 'required|string|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:12',
        ]);
        
        // Create a new user instance and assign values from the request
        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password); // Ensure the password is hashed

        // Save the user and handle the response
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

    // Handle user login
    public function loginUser(Request $request)
    {
        // Validate the login request
        $request->validate([
            'name'     => 'required|string',
            'password' => 'required|string|min:8',
        ]);
    
        // Retrieve the user by name
        $user = User::where('name', $request->name)->first();
    
        if (!$user) {
            return back()->with('fail', 'User not found.');
        }
    
        // Check if the provided password matches the hashed password in the database
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('fail', 'Incorrect password.');
        }
    
        // Store user id in the session for authentication
        Session::put('loginId', $user->id);
        
        // Debug session after authentication
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

    // Handle user logout
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
