<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\frontend\AppController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ReportController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\auth\LoginController;
use App\Http\Controllers\backend\NotificationController;
use App\Http\Controllers\backend\file\APKUploadController;
use App\Http\Controllers\frontend\auth\RegisterController;
use App\Http\Controllers\backend\file\ImageUploadController;
use App\Http\Controllers\backend\file\VideoUploadController;
use App\Http\Controllers\frontend\auth\ResetPasswordController;
use App\Http\Controllers\frontend\auth\ForgotPasswordController;

Route::get('/', [HomeController::class, 'index']);
// Route::get('/home', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/admin', [UserController::class, 'getLogin']);
Route::post('/admin', [UserController::class, 'postLogin']);

Route::get('/search', [AppController::class, 'search'])->name('search');
Route::get('/search/load-more', [AppController::class, 'loadMore'])->name('search.loadMore');

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

Route::get('/app/{id}', [AppController::class, 'show'])->name('app.details');

Route::resource('categories', CategoryController::class)
    ->names('frontend.categories');

Route::prefix('apps/{app}')->group(function () {
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index'); // Hiển thị tất cả đánh giá
    Route::post('reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store'); // Lưu đánh giá
});

Route::middleware('auth')->group(function () {
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::post('/report', [ReportController::class, 'store'])
    ->name('frontend.report');

Route::get('/{type}', [AppController::class, 'index'])
    ->where('type', 'apps|games|windows'); 

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
