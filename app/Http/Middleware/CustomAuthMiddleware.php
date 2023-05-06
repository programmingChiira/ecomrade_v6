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
        if (Str::contains($request->getRequestUri(), '/api/homemarketcategories') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/homerentalcategories') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/marketcategories') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/rentalcategories') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/locations') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/years') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/courses') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/marketreviews') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/rentalreviews') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/pollvotes') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/eventreviews') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/market-reviews/average-rating/{marketId}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/marketsubcategories') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/getmarketsubcategories') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/getmarketcategories') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/getrentalcategories') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/getlocations') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/getyears') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/getcourses') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/postreviews') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/resourcereviews') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/home-posts') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/posts/{post:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/clubs/{club:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/clubarticles/{club:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/clubmarkets/{club:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/clubevents/{club:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/clubpolls/{club:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/clubresources/{club:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/clubusers/{club:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/clubchats/{clubchat:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/userchats/{userchat:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/resources/{resource:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/markets/{market:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/rentals/{rental:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/polls/{poll:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/events/{event:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/users/{user:slug}') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/posts') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/clubs') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/clubchats') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/userchats') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        if (Str::contains($request->getRequestUri(), '/api/resources') && !$request->headers->has('referer')) {
            abort(500, 'Server Error');
        }
        
        return $next($request);
    }
}
