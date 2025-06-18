<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
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
                ActivityLog::create([
                    'user_id' => $user->id,
                    'action' => $this->getActivityAction($request),
                    'description' => $description,
                    'status' => $this->getActivityStatus($response),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
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

        // Admin activities
        if (str_starts_with($path, 'admin')) {
            if (str_contains($path, 'users')) {
                if ($method === 'POST') {
                    return 'Created new user';
                } elseif ($method === 'PUT') {
                    return 'Updated user';
                } elseif ($method === 'DELETE') {
                    return 'Deleted user';
                }
            }
        }

        return null;
    }

    private function getActivityStatus($response)
    {
        $statusCode = $response->getStatusCode();

        if ($statusCode >= 200 && $statusCode < 300) {
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
        // Admin activities
        if (str_starts_with($path, 'admin')) {
            if (str_contains($path, 'users')) {
                if ($method === 'POST') {
                    return 'create';
                } elseif ($method === 'PUT') {
                    return 'update';
                } elseif ($method === 'DELETE') {
                    return 'delete';
                }
            }
        }
        return 'other';
    }
} 