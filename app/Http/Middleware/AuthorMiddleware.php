<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'author' role
        if (Auth::check() && Auth::user()->role === 'author') {
            return $next($request);
        }

        // Redirect or deny access if the user is not an author
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
