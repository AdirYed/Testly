<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (! Auth::check()) {
            throw new AuthenticationException();
        }

        if (Auth::user()->role !== 'admin') {
            throw new AuthorizationException('You are not an admin.');
        }

        return $next($request);
    }
}
