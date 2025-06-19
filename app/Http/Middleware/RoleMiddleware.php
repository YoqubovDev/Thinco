<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'parent') {
                return redirect()->route('parent.index');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.index');
            }
        }

        return $next($request);
    }
}
