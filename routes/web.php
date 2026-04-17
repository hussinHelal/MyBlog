<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Authenticated routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('postShow');
    Route::resource('/posts', PostController::class)->except(['store', 'update', 'destroy']);

    Route::post('/post', [PostController::class, 'store'])->middleware('can:create-post,App\Models\Post')->name('postStore');
    Route::put('/post/{post}', [PostController::class, 'update'])->middleware('can:update-post,post')->name('postUpdate');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->middleware('can:destroy-post,post')->name('postDestroy');

    Route::get('/posts/category/{category}', [PostController::class, 'category'])->name('posts.category');
    Route::get('/posts/tag/{tag}', [PostController::class, 'tag'])->name('posts.tag');
    Route::get('/posts/author/{user}', [PostController::class, 'author'])->name('posts.author');

    Route::post('/like', [PostController::class, 'addLike'])->name('addLike');
    Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->name('comments.store');
    Route::delete('/comments/{comment}', [PostController::class, 'destroyComment'])->name('comments.destroy');

    // Admin
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'index')->name('admin');
        Route::post('/admin/{id}', 'edit')->name('edit-admin');
        Route::get('/admin/posts', 'showPosts')->name('showPosts');
        Route::get('/admin/users', 'showUsers')->name('showUsers');
        Route::get('/admin/category', 'showCategory')->name('showCategory');
        Route::get('/admin/comments', 'showComments')->name('showComment');
        Route::get('/admin/tags', 'showTags')->name('showTags');
    });

    Route::get('/admin/user', [AuthController::class, 'index'])->name('dashboard.users.index');
    Route::post('/admin/user', [AuthController::class, 'store'])->name('dashboard.users.store');
    Route::put('/admin/user/{target}', [AuthController::class, 'update'])->name('dashboard.users.update');
    Route::delete('/admin/user/{target}', [AuthController::class, 'destroy'])->name('dashboard.users.destroy');

    Route::resource('/user', User::class);
    Route::resource('/comments', CommentController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/tags', TagController::class);

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
