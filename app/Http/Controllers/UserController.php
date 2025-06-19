<?php

namespace App\Http\Controllers;

class UserController
{
    public function index(){
        return view('user.dashboard');
    }
}
