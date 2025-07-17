<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('Gelen data:', $request->all());

        dd(response()->json($request->all(), 201));
    }
}
