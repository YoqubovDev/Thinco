<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController
{
    public function index(){
        return view('user.dashboard');
    }

    public function check()
    {
        $user = Auth::user();

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
    }
}
