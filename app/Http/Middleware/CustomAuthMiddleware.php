<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomAuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        // Check if the request is coming from the UI
        if (Str::startsWith($request->header('referer'), config('app.url'))) {
            // Allow unauthenticated users to access the route
            return $next($request);
        }

        // Redirect unauthenticated users to the login page
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
