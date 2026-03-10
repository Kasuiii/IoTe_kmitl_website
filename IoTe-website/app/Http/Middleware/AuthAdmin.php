<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (!Auth::user()->isAdmin()) {
            abort(403, 'Access denied. Admins only.');
        }

        return $next($request);
    }
}
