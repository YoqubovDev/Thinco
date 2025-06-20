<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InteractiveGameController extends Controller
{
    public function AnimalSounds(){
        return view('games.interactive.animal-sounds');
    }
    public function MemoryGame()
    {
        return view('games.interactive.memory');
    }

    public function Alphabet()
    {
        return view('games.interactive.alphabet');
    }

    public function colors()
    {
        return view('games.interactive.colors');
    }
}
