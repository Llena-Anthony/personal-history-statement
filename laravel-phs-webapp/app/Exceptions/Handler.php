<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
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
    }
}
