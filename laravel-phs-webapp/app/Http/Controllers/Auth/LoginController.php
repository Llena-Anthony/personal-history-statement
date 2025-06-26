<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember'); // checkbox value

        // Check if user exists
        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            // Log failed login attempt for non-existent user
            Log::warning('Failed login attempt for non-existent user', [
                'username' => $credentials['username'],
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            throw ValidationException::withMessages([
                'username' => 'The username you entered does not exist.',
            ]);
        }

        // Check if user is active
        if (!$user->is_active) {
            // Log failed login attempt for inactive user
            Log::warning('Failed login attempt for inactive user', [
                'username' => $credentials['username'],
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            throw ValidationException::withMessages([
                'username' => 'Your account is inactive. Please contact the administrator.',
            ]);
        }

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Update last login timestamp
            $user->update(['last_login_at' => now()]);

            // Log successful login
            Log::info('Successful login', [
                'username' => $credentials['username'],
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Redirect based on user type
            if ($user->usertype === 'admin') {
                return redirect()->intended('admin/dashboard');
            }
            // All other users (clients) go to /dashboard
            return redirect()->intended('/dashboard');
        }

        // Log failed login attempt for incorrect password
        Log::warning('Failed login attempt - incorrect password', [
            'username' => $credentials['username'],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Incorrect password prompt
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
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
