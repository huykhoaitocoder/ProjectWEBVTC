<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\frontend\AppController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\YouTubeController;
use App\Http\Controllers\frontend\ReportController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\Backend\DeveloperController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\frontend\auth\LoginController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\frontend\UserProfileController;
use App\Http\Controllers\frontend\auth\RegisterController;
use App\Http\Controllers\Backend\Admin\AppManagementController;
use App\Http\Controllers\frontend\auth\ResetPasswordController;
use App\Http\Controllers\frontend\auth\ForgotPasswordController;
use App\Http\Controllers\frontend\auth\EmailVerificationController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/auth/youtube/callback', [YouTubeController::class, 'handleCallback']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile');
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-avatar', [UserProfileController::class, 'updateAvatar'])->name('profile.update_avatar');
});

Route::post('/send-otp', [EmailVerificationController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-otp', [EmailVerificationController::class, 'verifyOtp'])->name('verify.otp');

Route::get('/admin', [UserController::class, 'getLogin']);
Route::post('/admin', [UserController::class, 'postLogin']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/developers', [DeveloperController::class, 'index'])->name('admin.developers');
    Route::post('/admin/developers/{id}/reject', [DeveloperController::class, 'reject'])->name('admin.developers.reject');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/developer/register', [DeveloperController::class, 'showRegistrationForm'])->name('developer.register');
    Route::post('/developer/register', [DeveloperController::class, 'register'])->name('developer.register');
    Route::get('/check-developer-name', [DeveloperController::class, 'checkName'])->name('developer.checkName');
});

Route::middleware(['auth', 'developer'])->group(function () {
    Route::get('/developer/dashboard', [DeveloperController::class, 'dashboard'])->name('developer.dashboard');
    Route::get('/developer/apps', [DeveloperController::class, 'list'])->name('developer.apps');
    Route::get('/developer/apps/create', [DeveloperController::class, 'create'])->name('developer.apps.create');
    Route::post('/developer/apps/store', [DeveloperController::class, 'store'])->name('developer.apps.store');
    Route::get('/developer/coupons', [CouponController::class, 'index'])->name('developer.coupons.index');
    Route::get('/developer/coupons/create', [CouponController::class, 'create'])->name('developer.coupons.create');
    Route::post('/developer/coupons', [CouponController::class, 'store'])->name('developer.coupons.store');
    Route::delete('/developer/coupons/{id}', [CouponController::class, 'destroy'])->name('developer.coupons.destroy');
});

Route::get('/check-package-name', [AppController::class, 'checkPackageName']);

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

Route::get('/{type}', [AppController::class, 'index']);


//Route::get('/upload-image', [ImageUploadController::class, 'uploadForm'])->name('image.form');
//Route::post('/upload-image', [ImageUploadController::class, 'uploadImages'])->name('image.upload');


//Route::get('/upload-video', [VideoUploadController::class, 'uploadForm'])->name('video.upload.form');
//Route::post('/upload-video', [VideoUploadController::class, 'uploadVideo'])->name('video.upload');

//Route::get('/upload-apk', [APKUploadController::class, 'uploadForm'])->name('file.upload.form');
//Route::post('/upload-apk', [APKUploadController::class, 'uploadApk'])->name('file.upload.apk');

//admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Quản lý ứng dụng
    Route::get('/apps', [AppManagementController::class, 'index'])->name('admin.apps.index');
    Route::get('/app-details/{id}', [AppManagementController::class, 'getAppDetails'])->name('admin.app.details');
    Route::post('/update-status/{app}', [AppManagementController::class, 'updateStatus'])->name('admin.update.status');


});

