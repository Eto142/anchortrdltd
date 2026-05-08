<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // ✅ Import the base Controller
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccessCodeController extends Controller
{
   public function show()
{
    $user = Auth::user();

    // If already verified (1), redirect home
    if ($user->verified === 1) {
        return redirect()->route('home');
    }

    // Otherwise show access code page
    return view('auth.access-code');
}

public function verify(Request $request)
{
    $request->validate([
        'code1' => 'required|numeric|digits:1',
        'code2' => 'required|numeric|digits:1',
        'code3' => 'required|numeric|digits:1',
        'code4' => 'required|numeric|digits:1',
    ]);

    $enteredCode = trim($request->code1 . $request->code2 . $request->code3 . $request->code4);
    $user = Auth::user();

    if ((string) $enteredCode === (string) $user->access_code) {
        // Mark as verified
        $user->update(['verified' => 1]);

        return redirect()->route('home')->with('success', 'Access code verified!');
    }

    return back()->withErrors(['code1' => 'Invalid access code. Try again.']);
}

}
