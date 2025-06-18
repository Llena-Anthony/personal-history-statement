<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Conditional validation for branch based on organic role
        $branchValidation = $request->organic_role === 'civilian' 
            ? ['nullable', 'string', 'in:ARMY,NAVY,AIRFORCE']
            : ['required', 'string', 'in:ARMY,NAVY,AIRFORCE'];

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'organic_role' => ['nullable', 'string', 'in:civilian,enlisted,officer'],
            'branch' => $branchValidation,
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'name.required' => 'Name is required.',
            'username.required' => 'Username is required.',
            'username.unique' => 'This username is already taken.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'organic_role.in' => 'Please select a valid organic role.',
            'branch.required' => 'Please select a branch.',
            'branch.in' => 'Please select a valid branch.',
            'current_password.required_with' => 'Current password is required to set a new password.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.confirmed' => 'Password confirmation does not match.',
            'profile_photo.image' => 'Profile photo must be an image.',
            'profile_photo.mimes' => 'Profile photo must be a JPEG, PNG, JPG, or GIF file.',
            'profile_photo.max' => 'Profile photo must not exceed 2MB.',
        ]);

        try {
            // Update basic information
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->organic_role = $request->organic_role ?: null;
            
            // Handle branch based on organic role
            if ($request->organic_role === 'civilian') {
                $user->branch = 'PMA'; // Default for civilians
            } else {
                $user->branch = $request->branch ?: 'PMA';
            }

            // Handle password change
            if ($request->filled('new_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
                }
                $user->password = Hash::make($request->new_password);
            }

            // Handle profile photo upload
            if ($request->hasFile('profile_photo')) {
                Log::info('Profile photo upload started', [
                    'user_id' => $user->id,
                    'file_name' => $request->file('profile_photo')->getClientOriginalName(),
                    'file_size' => $request->file('profile_photo')->getSize()
                ]);

                // Delete old profile photo if exists
                if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                    Log::info('Old profile photo deleted', ['path' => $user->profile_photo_path]);
                }

                // Store the new profile photo
                $file = $request->file('profile_photo');
                $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('profile-photos', $filename, 'public');
                
                $user->profile_photo_path = $path;
                
                Log::info('Profile photo uploaded successfully', [
                    'path' => $path,
                    'full_url' => url('storage/' . $path)
                ]);
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