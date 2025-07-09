<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ProfilePictureHandler;

class ProfileController extends Controller
{
    use ProfilePictureHandler;

    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $userDetail = $user->userDetail;

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->username . ',username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user_details,email_addr,' . $user->username . ',username'],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        $changes = [];
        $originalEmail = $userDetail ? $userDetail->email_addr : null;
        $originalUsername = $user->username;

        // Update username if changed
        if ($user->username !== $validated['username']) {
            $user->username = $validated['username'];
            $changes[] = 'Username updated from ' . $originalUsername . ' to ' . $validated['username'];
            if ($userDetail) {
                // Update the userDetail primary key to match the new username
                $userDetail->username = $user->username;
                $userDetail->save();
            }
        }

        // Update password if requested
        if ($request->filled('current_password')) {
            if (!\Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
            }
            $user->password = \Hash::make($request->new_password);
            $changes[] = 'Password changed';
        }

        // Update email if changed
        if ($userDetail && $originalEmail !== $validated['email']) {
            $changes[] = 'Email updated from ' . $originalEmail . ' to ' . $validated['email'];
            $userDetail->email_addr = $validated['email'];
            $userDetail->save();
        }

        // Handle profile photo if present (like admin)
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
                $userDetail ? $userDetail->profile_path : null,
                $user->username
            );
            if ($userDetail) {
                $userDetail->profile_path = $path;
                $userDetail->save();
            }
            $changes[] = 'Profile picture updated';
        }

        $user->save();

        // Log profile update activity
        if (!empty($changes)) {
            \App\Models\ActivityLogDetail::create([
                'changes_made_by' => $user->username,
                'action' => 'update',
                'act_desc' => 'Profile updated: ' . implode(', ', $changes),
                'act_stat' => 'success',
                'ip_addr' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'act_date_time' => now(),
            ]);
        }

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['profile_picture' => 'You must be logged in to update your profile picture.']);
        }

        if (!$user->userDetail) {
            \Log::error('Profile update failed: userDetail relation missing for user', ['username' => $user->username]);
            return back()->withErrors(['profile_picture' => 'Profile details not found. Please contact admin.']);
        }

        try {
            // Use the trait method for efficient profile picture handling
            $path = $this->handleProfilePictureUpload(
                $request->file('profile_picture'),
                $user->userDetail->profile_path ?? null,
                $user->username
            );
            
            $user->userDetail->profile_path = $path;
            $saved = $user->userDetail->save();
            \Log::info('Profile picture path saved to user_details', [
                'username' => $user->username,
                'profile_path' => $path,
                'save_result' => $saved
            ]);

            // Log profile picture update activity
            \App\Models\ActivityLogDetail::create([
                'changes_made_by' => $user->username,
                'action' => 'update',
                'act_desc' => 'Profile picture updated',
                'act_stat' => 'success',
                'ip_addr' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'act_date_time' => now(),
            ]);

            return back()->with('success', 'Profile picture updated successfully.');
            
        } catch (\Exception $e) {
            return back()->withErrors(['profile_picture' => 'Failed to upload profile picture. Please try again.']);
        }
    }
} 