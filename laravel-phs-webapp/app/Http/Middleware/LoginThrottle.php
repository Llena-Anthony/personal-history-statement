<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class LoginThrottle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $this->resolveRequestSignature($request);

        // Progressive rate limiting: stricter limits for repeated failures
        $maxAttempts = $this->getMaxAttempts($request);
        $decayMinutes = $this->getDecayMinutes($request);

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            
            // Format the time message more precisely
            $timeMessage = $this->formatTimeMessage($seconds);
            
            return back()->withErrors([
                'username' => "Too many login attempts. Please wait {$timeMessage} before trying again.",
            ])->withInput($request->only('username'));
        }

        RateLimiter::hit($key, $decayMinutes * 60);

        $response = $next($request);

        // If login failed, increment the failure counter
        if ($response->getStatusCode() === 302 && !session()->has('auth.password_confirmed_at')) {
            RateLimiter::hit($key, $decayMinutes * 60);
        }

        return $response;
    }

    /**
     * Resolve request signature.
     */
    protected function resolveRequestSignature(Request $request): string
    {
        return sha1(implode('|', [
            $request->ip(),
            $request->userAgent(),
            $request->input('username', ''),
        ]));
    }

    /**
     * Get the maximum number of attempts for the given request.
     */
    protected function getMaxAttempts(Request $request): int
    {
        // Progressive rate limiting based on IP and username
        $key = $this->resolveRequestSignature($request);
        $attempts = RateLimiter::attempts($key);
        
        if ($attempts >= 10) {
            return 1; // Only 1 attempt per minute after 10+ failures
        } elseif ($attempts >= 5) {
            return 2; // 2 attempts per minute after 5+ failures
        }
        
        return 5; // Default: 5 attempts per minute
    }

    /**
     * Get the number of minutes to throttle for.
     */
    protected function getDecayMinutes(Request $request): int
    {
        $key = $this->resolveRequestSignature($request);
        $attempts = RateLimiter::attempts($key);
        
        if ($attempts >= 10) {
            return 5; // 5 minutes after 10+ failures
        } elseif ($attempts >= 5) {
            return 2; // 2 minutes after 5+ failures
        }
        
        return 1; // Default: 1 minute
    }

    /**
     * Format time message for better user experience.
     */
    protected function formatTimeMessage(int $seconds): string
    {
        if ($seconds < 60) {
            return "{$seconds} seconds";
        } elseif ($seconds < 120) {
            $minutes = floor($seconds / 60);
            $remainingSeconds = $seconds % 60;
            return "{$minutes} minute" . ($remainingSeconds > 0 ? " and {$remainingSeconds} seconds" : "");
        } else {
            $minutes = floor($seconds / 60);
            return "{$minutes} minutes";
        }
    }
}
