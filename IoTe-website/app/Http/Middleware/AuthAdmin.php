<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Not logged in at all
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Logged in but not admin
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Access denied. Admins only.');
            // Or redirect instead:
            // return redirect('/dashboard')->with('error', 'You do not have permission.');
        }

        return $next($request); // ✅ Is admin, let them through
    }
}
