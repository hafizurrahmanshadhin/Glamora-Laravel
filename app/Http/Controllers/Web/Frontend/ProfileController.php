<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {
    public function updateProfile(Request $request) {
        $user      = Auth::user();
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'phone_number' => 'required|string|unique:users,phone_number,' . $user->id,
            'address'      => 'required|string',
            'avatar'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        $user->first_name   = $validated['first_name'];
        $user->last_name    = $validated['last_name'];
        $user->phone_number = $validated['phone_number'];
        $user->address      = $validated['address'];

        if ($request->hasFile('avatar')) {
            $user->avatar = Helper::fileUpload($request->file('avatar'), 'avatars', $validated['first_name']);
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request) {
        $user      = Auth::user();
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($validated['new_password']);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
