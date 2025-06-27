<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Database\QueryException;
use PDOException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Custom handler for throttle exceptions on login
        $this->renderable(function (ThrottleRequestsException $e, $request) {
            if ($request->is('login') && $request->isMethod('post')) {
                return back()->withErrors([
                    'username' => 'Too many login attempts. Please wait a minute before trying again.',
                ])->withInput($request->only('username'));
            }
        });

        // Custom handler for database connection errors
        $this->renderable(function (Throwable $e, $request) {
            if ($e instanceof QueryException || $e instanceof PDOException) {
                $message = $e->getMessage();
                
                // Check if it's a connection refused error
                if (str_contains($message, 'No connection could be made') || 
                    str_contains($message, 'Connection refused') ||
                    str_contains($message, 'SQLSTATE[HY000] [2002]')) {
                    
                    if ($request->is('login') && $request->isMethod('post')) {
                        return back()->withErrors([
                            'username' => 'System is currently under maintenance. Please try again later.',
                        ])->withInput($request->only('username'));
                    }
                    
                    // For other requests, show a maintenance page
                    return response()->view('errors.maintenance', [], 503);
                }
            }
        });
    }
}
