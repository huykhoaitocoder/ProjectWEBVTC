<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Trang chủ
Route::get('/', function () {
    return view('Frontend.home');
})->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
// Đăng ký
Route::get('/admin/register', [AuthController::class, 'showRegisterForm'])->name('admin.register.show');
Route::post('/admin/register', [AuthController::class, 'register'])->name('admin.register');

// Đăng nhập
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login.show');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');

// Đăng xuất - nên là POST để bảo mật tốt hơn
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard - Trang chính sau khi đăng nhập
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

Route::post('/cart/add', [CartController::class, 'add'])->name('add_to_cart');
