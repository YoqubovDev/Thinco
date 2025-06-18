<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
Route::get('/', fn () => view('welcome'));
Route::get('/SmartExam', fn () => view('SmartExam'));
Route::get('/InteraktivGamePlay', fn () => view('InteraktivGamePlay'));
Route::get('/MotivatsionWin', fn () => view('MotivatsionWin'));
Route::get('/ParentControl', fn () => view('ParentControl'));
Route::get('/dashboard', fn () => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Route::get('/admin', [AdminController::class, 'index'])->middleware('role:admin');
//Route::get('/dashboard', [UserController::class, 'index'])->middleware('auth');


Route::get('/admin_dashboard', fn () => view('admin_dashboard'));

Route::get('/teacher', function () {
    return 'Salom, o‘qituvchi!';
})->middleware('role:teacher');


Route::get('/gameList', fn () => view('gameList'));

require __DIR__.'/auth.php';
