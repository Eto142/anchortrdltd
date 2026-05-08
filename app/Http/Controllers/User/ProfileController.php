<?php

namespace App\Http\Controllers\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        return view('user.profile');
    }

    public function settings()
    {
        return view('user.profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone'   => 'nullable|string|max:20',
            'dob'     => 'nullable|date',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update($request->only([
            'name',
            'email',
            'phone',
            'dob',
            'address',
        ]));

        return back()->with('success', 'Profile updated successfully.');
    }
}
