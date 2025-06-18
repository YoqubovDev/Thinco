<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (method_exists($user, 'hasRole') && !$user->hasRole($role)) {
            abort(403, 'Sizda ushbu sahifaga ruxsat yo‘q!');
        }

        if (!$user->roles()->where('name', $role)->exists()) {
            abort(403, 'Sahifaga kirish uchun sizda huquq yo‘q.');
        }

        return $next($request);
    }
}
