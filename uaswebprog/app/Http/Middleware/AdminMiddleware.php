<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request 
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Only allow admins to proceed
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Redirect non-admin users trying to access admin routes
        return redirect(Auth::check() ? '/dashboard' : '/');
    }

    
}
