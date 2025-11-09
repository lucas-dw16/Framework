<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- Show login form ---
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // --- Handle login ---
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.'
            ]);
        }

        $request->session()->regenerate();

        return redirect('/jobs');
    }

    // --- Show register form ---
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // --- Handle register ---
    public function register(Request $request)
    {
    $attributes = $request->validate([
    'first_name' => 'required|string|max:255',
    'last_name'  => 'required|string|max:255',
    'email'      => 'required|email|unique:users,email',
    'password'   => 'required|confirmed|min:6',
]);

$user = User::create([
    'first_name' => $attributes['first_name'],
    'last_name'  => $attributes['last_name'],
    'email'      => $attributes['email'],
    'password'   => Hash::make($attributes['password']),
]);


        Auth::login($user);

        return redirect('/jobs');
    }

    // --- Logout ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
