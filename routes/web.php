<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Route::get('/admin', [AdminController::class, 'index'])->middleware('role:admin');
//Route::get('/dashboard', [UserController::class, 'index'])->middleware('auth');


Route::get('/admin', function () {
    return 'Xush kelibsiz, admin!';
})->middleware('role:admin');

Route::get('/teacher', function () {
    return 'Salom, o‘qituvchi!';
})->middleware('role:teacher');


require __DIR__.'/auth.php';
