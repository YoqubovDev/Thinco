<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();


        $token = $user->createToken('web-token')->plainTextToken;

        session(['api_token' => $token]);

        $role = $user->roles()->first();

        if ($role) {
            switch ($role->name) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'parent':
                    return redirect()->route('parent.dashboard');
                case 'user':
                    return redirect()->route('user.dashboard');
                default:
                    return redirect()->route('dashboard');
            }
        }

        return redirect()->route('dashboard');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
