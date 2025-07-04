<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\ActivityLogDetail;

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
            ActivityLogDetail::create([
                'changes_made_by' => $credentials['username'],
                'action' => 'login',
                'act_desc' => 'Failed login attempt for non-existent user',
                'act_stat' => 'warning',
                'ip_addr' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'act_date_time' => now(),
            ]);

            throw ValidationException::withMessages([
                'username' => 'The username you entered does not exist.',
            ]);
        }

        // Check if user is active
        if ($user->is_active != '1' && $user->is_active != 1) {
            // Log failed login attempt for inactive user
            ActivityLogDetail::create([
                'changes_made_by' => $credentials['username'],
                'action' => 'login',
                'act_desc' => 'Failed login attempt for inactive user',
                'act_stat' => 'warning',
                'ip_addr' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'act_date_time' => now(),
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
            ActivityLogDetail::create([
                'changes_made_by' => $credentials['username'],
                'action' => 'login',
                'act_desc' => 'Successful login',
                'act_stat' => 'success',
                'ip_addr' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'act_date_time' => now(),
            ]);

            // Redirect based on user type
            if ($user->usertype === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }
            if ($user->usertype === 'personnel') {
                return redirect()->intended(route('personnel.dashboard'));
            }
            return redirect()->intended(route('client.dashboard'));

        }

        // Log failed login attempt for incorrect password
        ActivityLogDetail::create([
            'changes_made_by' => $credentials['username'],
            'action' => 'login',
            'act_desc' => 'Failed login attempt - incorrect password',
            'act_stat' => 'warning',
            'ip_addr' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'act_date_time' => now(),
        ]);

        // Incorrect password prompt
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        // Log logout activity before logging out
        if (Auth::check()) {
            ActivityLogDetail::create([
                'changes_made_by' => Auth::user()->username,
                'action' => 'logout',
                'act_desc' => 'User logged out',
                'act_stat' => 'success',
                'ip_addr' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'act_date_time' => now(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been successfully logged out.');
    }
}
