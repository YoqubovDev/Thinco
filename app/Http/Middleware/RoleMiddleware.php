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
            // Login qilmagan foydalanuvchi
            return redirect()->route('login');
        }

        if (!$request->user()->hasRole($role)) {
            // Roli mos kelmasa, 403 yoki boshqa sahifaga yo'naltiradi
            abort(403, 'Sizda ushbu sahifaga ruxsat yo‘q!');
        }

        return $next($request);
    }
}
