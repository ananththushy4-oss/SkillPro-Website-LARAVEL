<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        return view('register'); // resources/views/register.blade.php
    }

    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'phone'         => 'required|string|max:20|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'role'          => 'required|in:Student,Admin,Instructor',
            'date_of_birth' => 'nullable|date',
            'forgot_pin'    => 'nullable|digits:4',
            'register_code' => 'nullable|digits:4',
        ]);

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),
            'role'          => $request->role,
            'date_of_birth' => $request->date_of_birth,
            'forgot_pin'    => $request->forgot_pin,
            'register_code' => $request->register_code,
        ]);

        Auth::login($user);

        return redirect()->route('login.form')->with('success', 'Registration successful!');
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('login'); // resources/views/login.blade.php
    }

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'required|in:Student,Admin,Instructor',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password) && $user->role === $request->role) {
            Auth::login($user);
            // Role-based redirection
        switch ($user->role) {
        case 'Admin':
            return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
        case 'Student':
            return redirect()->route('student.dashboard')->with('success', 'Login successful!');
        case 'Instructor':
            return redirect()->route('instructor.dashboard')->with('success', 'Login successful!');
        default:
            Auth::logout();
            return back()->withErrors(['login' => 'Role not recognized.']);
    }

        }

        return back()->withErrors([
            'login' => 'Invalid credentials or role mismatch.',
        ]);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form')->with('success', 'You have been logged out.');
    }

    /**
     * Show dashboard based on user role
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Role-based content can be handled in the Blade
        return view('dashboard', compact('user'));
    }

    /**
     * Handle forgot password reset using email + forgot pin
     */
    public function resetPassword(Request $request)
    {
        // Validate input
        $request->validate([
            'email'     => 'required|email|exists:users,email',
            'forgotPin' => 'required|digits:4',
            'password'  => 'required|string|min:6|confirmed',
        ]);

        // Find user by email and forgot pin
        $user = User::where('email', $request->email)
            ->where('forgot_pin', $request->forgotPin)
            ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Invalid email or forgot pin.',
            ])->withInput();
        }

        // Update password without clearing the pin
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login.form')->with('success', 'Password reset successfully! You can now login.');
    }
}
