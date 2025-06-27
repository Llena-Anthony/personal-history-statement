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

        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        $changes = [];
        $originalData = $user->only(['email']);

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
            }

            $user->password = Hash::make($request->new_password);
            $changes[] = 'Password changed';
        }

        if ($user->email !== $validated['email']) {
            $changes[] = 'Email updated from ' . $user->email . ' to ' . $validated['email'];
        }

        $user->fill([
            'email' => $validated['email'],
        ]);

        $user->save();

        // Log profile update activity
        if (!empty($changes)) {
            \App\Models\ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'update',
                'description' => 'Profile updated: ' . implode(', ', $changes),
                'status' => 'success',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
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

        try {
            // Use the trait method for efficient profile picture handling
            $path = $this->handleProfilePictureUpload(
                $request->file('profile_picture'),
                $user->profile_picture,
                $user->id
            );
            
            $user->profile_picture = $path;
            $user->save();

            // Log profile picture update activity
            \App\Models\ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'update',
                'description' => 'Profile picture updated',
                'status' => 'success',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return back()->with('success', 'Profile picture updated successfully.');
            
        } catch (\Exception $e) {
            return back()->withErrors(['profile_picture' => 'Failed to upload profile picture. Please try again.']);
        }
    }
} 