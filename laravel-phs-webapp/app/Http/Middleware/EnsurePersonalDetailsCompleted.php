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

        // Adjust these relationship checks as needed
        if (!$user || !$user->personalChar || !$user->userDetails) {
            return redirect()->route('phs.personal-details')->with('error', 'Please complete Personal Details first.');
        }

        return $next($request);
    }
}
