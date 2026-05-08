<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{





    // Show forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Send reset link
  

    // Show reset password form
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Reset password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['success' => true, 'message' => __($status), 'redirect' => route('login')])
            : response()->json(['success' => false, 'message' => __($status)], 400);
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::logout(); // Logs out the user
        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Regenerates the CSRF token

        return redirect('/login'); // Redirects to the homepage or login page
    }




    public function showVerifyForm()
{
    return view('auth.verify');
}

// public function verifyCode(Request $request)
// {
//     $request->validate([
//         'email' => 'required|email',
//         'code'  => 'required|digits:6',
//     ]);

//     $user = User::where('email', $request->email)
//                 ->where('verification_code', $request->code)
//                 ->first();

//     if ($user) {
//         $user->is_verified = true;
//         $user->verification_code = null;
//         $user->save();

//         return redirect()->route('login')->with('success', 'Account verified! You can now log in.');
//     }

//     return back()->withErrors(['code' => 'Invalid verification code.']);
// }


public function verifyCode(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'code'  => 'required|digits:6',
    ]);

    $user = User::where('email', $request->email)
                ->where('verification_code', $request->code)
                ->first();

    if ($user) {
        $user->is_verified = 1; // integer instead of true
        $user->verification_code = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Account verified! You can now log in.');
    }

    return back()->withErrors(['code' => 'Invalid verification code.']);
}


}
