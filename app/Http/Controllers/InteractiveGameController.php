<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InteractiveGameController extends Controller
{
    public function AnimalSounds(){
        return view('games.interactive.animal-sounds');
    }
}
