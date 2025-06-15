<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Please enter your username.',
            'password.required' => 'Please enter your password.',
        ]);

        // Check if user exists
        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'username' => 'The username you entered does not exist.',
            ]);
        }

        // Check if user is active
        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'username' => 'Your account is inactive. Please contact the administrator.',
            ]);
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirect based on user type
            if ($user->usertype === 'admin') {
                return redirect()->intended('admin/dashboard');
            }
            return redirect()->intended('client/dashboard');
        }

        // If we get here, the password is wrong
        throw ValidationException::withMessages([
            'password' => 'The password you entered is incorrect.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been successfully logged out.');
    }
} 