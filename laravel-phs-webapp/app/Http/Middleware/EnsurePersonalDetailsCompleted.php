<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsurePersonalDetailsCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Only check for Personal Details completion (section I)
        // Personal Characteristics is section II and shouldn't require itself to be completed
        if (!$user || !$user->userDetails) {
            return redirect()->route('phs.create')->with('error', 'Please complete Personal Details first.');
        }

        return $next($request);
    }
}
