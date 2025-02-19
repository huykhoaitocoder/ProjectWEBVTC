<?php

use App\Http\Controllers\backend\file\APKUploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\frontend\AppController;
use App\Http\Controllers\frontend\PageController;
use App\Http\Controllers\frontend\CustomerController;
use App\Http\Controllers\backend\file\ImageUploadController;
use App\Http\Controllers\backend\file\VideoUploadController;

Route::get('/', [PageController::class, 'index']);
// Route::get('/home', [PageController::class, 'index']);

Route::get('/login', [CustomerController::class, 'index']);

Route::get('/admin', [UserController::class, 'getLogin']);
Route::post('/admin', [UserController::class, 'postLogin']);

Route::get('/app/{id}', [AppController::class, 'show'])->name('app.details');

Route::get('/upload-image', [ImageUploadController::class, 'uploadForm'])->name('image.form');
Route::post('/upload-image', [ImageUploadController::class, 'uploadImages'])->name('image.upload');


Route::get('/upload-video', [VideoUploadController::class, 'uploadForm'])->name('video.upload.form');
Route::post('/upload-video', [VideoUploadController::class, 'uploadVideo'])->name('video.upload');

Route::get('/upload-apk', [APKUploadController::class, 'uploadForm'])->name('file.upload.form');
Route::post('/upload-apk', [APKUploadController::class, 'uploadApk'])->name('file.upload.apk');

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
