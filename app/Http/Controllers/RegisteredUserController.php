<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    // Laat het registratieformulier zien
    public function create()
    {
        return view('auth.register');
    }

    // Verwerk registratie
    public function store(Request $request)
    {
        // Validatie
        $attributes = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|confirmed|min:6',
        ]);

        // Maak gebruiker aan
        $user = User::create([
            'first_name' => $attributes['first_name'],
            'last_name'  => $attributes['last_name'],
            'email'      => $attributes['email'],
            'password'   => Hash::make($attributes['password']),
        ]);

        // Log direct in
        auth()->login($user);

        return redirect('/jobs')->with('success', 'Account created successfully!');
    }
}
