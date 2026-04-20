<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        Gate::authorize('update_user', $user);

        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,

            // password fields are optional — only validated if user fills them
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // update name & email
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // update password only if user filled the fields
        if ($request->filled('password')) {

            // check that current password is correct
            if (! Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('profile.edit', $user->id)->with('success', 'Profile updated.');
    }
}
