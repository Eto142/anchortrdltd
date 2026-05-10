<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->first_name . ' ' . $request->last_name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect()->route('register.profile');
    }

    public function showProfileSetup()
    {
        return view('auth.profile-setup');
    }

    public function saveProfile(Request $request)
    {
        $request->validate([
            'phone'   => 'required|string|max:30',
            'country' => 'required|string|max:100',
            'state'   => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'dob'     => 'nullable|date|before:today',
        ]);

        auth()->user()->update([
            'phone'   => $request->phone,
            'country' => $request->country,
            'state'   => $request->state,
            'address' => $request->address,
            'dob'     => $request->dob,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Welcome! Your profile has been set up.');
    }
}
