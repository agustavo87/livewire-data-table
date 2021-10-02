<?php

use App\Http\Controllers\LoginController;
use App\Http\Livewire\Auth\{Login, Register};
use Illuminate\Support\Facades\Route;

/**
 *  App routes
 */
Route::middleware('auth')->group(function () {
    Route::redirect('/', '/dashboard');
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

/**
 * Authentication
 */
Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});
