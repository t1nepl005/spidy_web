<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show profile edit form
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    // Update name/email/username
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    // Show password change form
    public function password()
    {
        return view('profile.password');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.password')->with('success', 'Password updated successfully!');
    }
}
