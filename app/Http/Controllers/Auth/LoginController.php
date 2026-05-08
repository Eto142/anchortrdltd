<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function showLoginForm(){
        return view('auth.login');
    }



    /**
     * Handle login request.
     */
public function login(Request $request)
{
    // ✅ Validate inputs
    $request->validate([
        'email'    => 'required|string',
        'password' => 'required|string',
    ]);

    $loginValue = $request->email;

    // ✅ Detect whether email or account ID
    $field = filter_var($loginValue, FILTER_VALIDATE_EMAIL)
        ? 'email'
        : 'id_number';

    // ✅ Attempt login
    if (Auth::attempt([
        $field    => $loginValue,
        'password'=> $request->password
    ])) {

        $request->session()->regenerate();

       return redirect()->route('user.dashboard')
    ->with('success', 'Login successful');
    }

    return back()->withErrors([
        'email' => 'Invalid email/account ID or password.',
    ]);
}





    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}


