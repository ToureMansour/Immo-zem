<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Routes d'authentification simples
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
