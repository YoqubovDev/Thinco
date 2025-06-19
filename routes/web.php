<?php

use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


Route::get('/', fn () => view('welcome'));
Route::get('/SmartExam', fn () => view('SmartExam'));
Route::get('/InteraktivGamePlay', fn () => view('InteraktivGamePlay'));
Route::get('/MotivatsionWin', fn () => view('MotivatsionWin'));
Route::get('/ParentControl', fn () => view('ParentControl'));
Route::get('/about', fn () => view('about'));
Route::get('/feedback', fn () => view('feedback'));
//Route::get('/dashboard', fn () => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('role:admin')->group(function () {
    Route::prefix('admin')->group(function () {
       Route::get('/', [AdminController::class, 'index'])->middleware('role:admin')->name('admin.dashboard');
    });
});

Route::middleware('role:parent')->group(function () {
    Route::prefix('parent')->group(function () {
      Route::get('/', [ParentController::class, 'index'])->middleware('role:parent')->name('parent.index');
    });
});

Route::middleware('role:user')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->middleware('role:user')->name('user.index');
    });
});


Route::get('/gameList', fn () => view('gameList'));




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
