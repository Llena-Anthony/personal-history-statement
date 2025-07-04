<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Traits\ProfilePictureHandler;

class ProfileController extends Controller
{
    use ProfilePictureHandler;

    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $userDetail = $user->userDetail;
        $changes = [];
        $originalUsername = $user->username;

        // Only validate and update username if present and changed
        if ($request->has('username') && $user->username !== $request->username) {
            $request->validate([
                'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            ], [
                'username.required' => 'Username is required.',
                'username.unique' => 'This username is already taken.',
            ]);
            $user->username = $request->username;
            $changes[] = 'Username updated from ' . $originalUsername . ' to ' . $request->username;
        }

        // Only validate and update password if new_password is present
        if ($request->filled('new_password')) {
            $request->validate([
                'current_password' => ['required'],
                'new_password' => ['min:8', 'confirmed'],
            ], [
                'current_password.required' => 'Current password is required to set a new password.',
                'new_password.min' => 'New password must be at least 8 characters.',
                'new_password.confirmed' => 'Password confirmation does not match.',
            ]);
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
            }
            $user->password = Hash::make($request->new_password);
            $changes[] = 'Password changed';
        }

        // Only handle profile photo if present
        if ($request->hasFile('profile_photo')) {
            $request->validate([
                'profile_photo' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ], [
                'profile_photo.image' => 'Profile photo must be an image.',
                'profile_photo.mimes' => 'Profile photo must be a JPEG, PNG, JPG, or GIF file.',
                'profile_photo.max' => 'Profile photo must not exceed 2MB.',
            ]);
            $path = $this->handleProfilePictureUpload(
                $request->file('profile_photo'),
                $user->userDetail ? $user->userDetail->profile_path : null,
                crc32($user->username)
            );
            if ($user->userDetail) {
                $user->userDetail->profile_path = $path;
                $user->userDetail->save();
            }
            $changes[] = 'Profile picture updated';
        }

        $user->save();

        // Log profile update activity
        if (!empty($changes)) {
            \App\Models\ActivityLogDetail::create([
                'changes_made_by' => $user->username,
                'action' => 'update',
                'act_desc' => 'Admin profile updated: ' . implode(', ', $changes),
                'act_stat' => 'success',
                'ip_addr' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'act_date_time' => now(),
            ]);
        }

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully!');
    }
} 