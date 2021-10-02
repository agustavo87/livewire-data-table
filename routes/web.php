<?php

use App\Http\Controllers\LoginController;
use App\Http\Livewire\Auth\{Login, Register};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['success'];
})->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::view('/home', 'home')->name('home');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
