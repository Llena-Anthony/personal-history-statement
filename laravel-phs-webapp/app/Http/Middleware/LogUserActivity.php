<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ActivityLogDetail;
use Illuminate\Support\Facades\Auth;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            $user = Auth::user();
            $description = $this->getActivityDescription($request);
            
            if ($description) {
                ActivityLogDetail::create([
                    'changes_made_by' => $user->username,
                    'action' => $this->getActivityAction($request),
                    'act_desc' => $description,
                    'act_stat' => $this->getActivityStatus($response),
                    'ip_addr' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'act_date_time' => now(),
                ]);

                // Update last login time
                if ($request->is('login')) {
                    $user->update(['last_login_at' => now()]);
                }
            }
        }

        return $response;
    }

    private function getActivityDescription(Request $request)
    {
        $path = $request->path();
        $method = $request->method();

        // Login activity
        if ($path === 'login' && $method === 'POST') {
            return 'User logged in';
        }

        // Logout activity
        if ($path === 'logout' && $method === 'POST') {
            return 'User logged out';
        }

        // PHS submission activities
        if (str_starts_with($path, 'phs')) {
            if ($method === 'POST') {
                return 'Submitted PHS form';
            } elseif ($method === 'PUT') {
                return 'Updated PHS submission';
            } elseif ($method === 'DELETE') {
                return 'Deleted PHS submission';
            }
        }

        // PDS submission activities
        if (str_starts_with($path, 'pds')) {
            if ($method === 'POST') {
                return 'Submitted PDS form';
            } elseif ($method === 'PUT') {
                return 'Updated PDS submission';
            } elseif ($method === 'DELETE') {
                return 'Deleted PDS submission';
            }
        }

        // Admin activities - skip user updates as they're handled manually
        if (str_starts_with($path, 'admin')) {
            if (str_contains($path, 'users')) {
                // Skip user creation and updates as they're handled manually in AdminUserController
                if ($method === 'DELETE') {
                    return 'Deleted user';
                }
            }
        }

        return null;
    }

    private function getActivityStatus($response)
    {
        $statusCode = $response->getStatusCode();

        // Treat 2xx and 3xx as success
        if ($statusCode >= 200 && $statusCode < 400) {
            return 'success';
        } elseif ($statusCode >= 400 && $statusCode < 500) {
            return 'warning';
        } else {
            return 'error';
        }
    }

    private function getActivityAction(Request $request)
    {
        $path = $request->path();
        $method = $request->method();

        // Login activity
        if ($path === 'login' && $method === 'POST') {
            return 'login';
        }
        // Logout activity
        if ($path === 'logout' && $method === 'POST') {
            return 'logout';
        }
        // PHS submission activities
        if (str_starts_with($path, 'phs')) {
            if ($method === 'POST') {
                return 'submit';
            } elseif ($method === 'PUT') {
                return 'update';
            } elseif ($method === 'DELETE') {
                return 'delete';
            }
        }
        // PDS submission activities
        if (str_starts_with($path, 'pds')) {
            if ($method === 'POST') {
                return 'submit';
            } elseif ($method === 'PUT') {
                return 'update';
            } elseif ($method === 'DELETE') {
                return 'delete';
            }
        }
        // Admin activities - skip user updates as they're handled manually
        if (str_starts_with($path, 'admin')) {
            if (str_contains($path, 'users')) {
                // Skip user creation and updates as they're handled manually in AdminUserController
                if ($method === 'DELETE') {
                    return 'delete';
                }
            }
        }
        return 'other';
    }
} 