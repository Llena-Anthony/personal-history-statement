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

        $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        
            'username.required' => 'Username is required.',
            'username.unique' => 'This username is already taken.',
            'current_password.required_with' => 'Current password is required to set a new password.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.confirmed' => 'Password confirmation does not match.',
            'profile_photo.image' => 'Profile photo must be an image.',
            'profile_photo.mimes' => 'Profile photo must be a JPEG, PNG, JPG, or GIF file.',
            'profile_photo.max' => 'Profile photo must not exceed 2MB.',
        ]);

        try {
            // Update only editable fields
            $user->username = $request->username;

            // Handle password change
            if ($request->filled('new_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
                }
                $user->password = Hash::make($request->new_password);
                $user->save();

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->with('success', 'Password changed successfully. Please log in again.');
            }

            // Handle profile photo upload using the trait
            if ($request->hasFile('profile_photo')) {
                Log::info('Profile photo upload started', [
                    'user_id' => $user->id,
                    'file_name' => $request->file('profile_photo')->getClientOriginalName(),
                    'file_size' => $request->file('profile_photo')->getSize()
                ]);

                // Use the trait method for efficient profile picture handling
                $path = $this->handleProfilePictureUpload(
                    $request->file('profile_photo'),
                    $user->profile_picture,
                    $user->id
                );
                
                $user->profile_picture = $path;
            }

            $user->save();

            Log::info('Profile updated successfully', ['user_id' => $user->id]);

            return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            Log::error('Profile update failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withErrors(['error' => 'An error occurred while updating your profile. Please try again.'])->withInput();
        }
    }
} 