<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route untuk halaman utama/dashboard
Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');

// Route untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route untuk register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route untuk profil
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');

// Route untuk edit profil
Route::post('/profile/edit', [AuthController::class, 'updateProfile'])->name('profile.update');

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk mengubah password
Route::post('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password');

// Route untuk menghapus pengguna
Route::delete('/profile/delete', [AuthController::class, 'destroy'])->name('profile.delete');
