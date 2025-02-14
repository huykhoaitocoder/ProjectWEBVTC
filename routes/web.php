<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Trang chủ
Route::get('/', function () {
    return view('home');
})->name('home');

// Đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Đăng xuất - nên là POST để bảo mật tốt hơn
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard - Trang chính sau khi đăng nhập
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');
