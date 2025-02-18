<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\frontend\AppController;
use App\Http\Controllers\frontend\PageController;

Route::get('/', [PageController::class, 'index']);
// Route::get('/home', [PageController::class, 'index']);

Route::get('/admin', [UserController::class, 'getLogin']);
Route::post('/admin', [UserController::class, 'postLogin']);

Route::get('/app/{id}', [AppController::class, 'show'])->name('app.details');

// // Đăng ký
// Route::get('/admin/register', [AuthController::class, 'showRegisterForm'])->name('admin.register.show');
// Route::post('/admin/register', [AuthController::class, 'register'])->name('admin.register');

// // Đăng nhập
// Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login.show');
// Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');

// // Đăng xuất - nên là POST để bảo mật tốt hơn
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // Dashboard - Trang chính sau khi đăng nhập
// Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

// Route::post('/cart/add', [CartController::class, 'add'])->name('add_to_cart');
