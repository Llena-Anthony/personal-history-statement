<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LinkedClientAccessOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Only allow if user is a client, and logged in via admin-switch
        if (
            $user->usertype !== 'client' ||
            !session('admin_linked_mode') ||
            !session('original_admin_id')
        ) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
