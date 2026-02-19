<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\AuthController;

// Route::post('/login', [LoginController::class,'login']);
// Route::post('/logout', [LoginController::class,'logout'])->middleware('auth:web');


// Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);

// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [PostController::class,'index']);
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

