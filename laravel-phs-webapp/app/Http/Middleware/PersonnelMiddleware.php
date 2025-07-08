<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonnelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check 'usertype' field for personnel
        if (auth()->check() && auth()->user()->usertype === 'personnel') {
            $response = $next($request);
            return $response
                ->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                ->header('Pragma','no-cache')
                ->header('Expires','Sat, 01 Jan 1990 00:00:00 GMT');
        }
        abort(403, 'Unauthorized');
    }
} 