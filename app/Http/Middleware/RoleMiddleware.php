<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        if (!$user || !$user->roles()->whereIn('name', $roles)->exists()) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
