<?php

use App\Http\Controllers\LoginController;
use App\Http\Livewire\Auth\{Login, Register};
use App\Http\Livewire\{Dashboard, Profile};
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

/**
 *  App routes
 */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

/**
 * Authentication
 */
Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});
