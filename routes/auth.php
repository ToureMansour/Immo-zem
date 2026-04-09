<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

// Routes d'authentification simples
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes pour mot de passe oublié
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/verify-reset-code', [ForgotPasswordController::class, 'showVerifyForm'])->name('password.verify.form');
Route::post('/verify-reset-code', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify');
Route::get('/reset-password/{email}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
