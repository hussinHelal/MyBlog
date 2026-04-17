<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\user;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\TagController;
// use App\Http\Controllers\CommentController;
// use App\Http\Controllers\Auth\ResetPasswordController;
// use App\Http\Controllers\Auth\VerificationController;
// Route::post('/login', [LoginController::class,'login']);
// Route::post('/logout', [LoginController::class,'logout'])->middleware('auth:web');


// Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);

// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/', [PostController::class,'index'])->name('index');
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// web.php
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    // Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/login', [LoginController ::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

    // Password reset
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Email verification
Route::get('/email/verify', fn() => view('auth.verify'))
    ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware('signed')->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Authenticated routes
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
//     Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
//     Route::post('/settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
// });
