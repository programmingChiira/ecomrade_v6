<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Str::contains($request->getRequestUri(), '/api/markets') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/connections') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/categories') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }

        return $next($request);
    }
}
