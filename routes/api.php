<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\AdminController;

//Route::get('/', function () {
//    return response()->json(['message' => 'Hello world!']);
//});

Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware('auth')->group(function () {
    
    Route::get('/', [PostController::class, 'index'])->name('index');

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('postShow');
    Route::resource('/posts',PostController::class);

    Route::get('/notes',[NotesController::class,'index']);
    Route::get('/notes/{note}',[NotesController::class,'show'])->name('notesShow');
    Route::resource('/notes',NotesController::class);

    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin','index')->name('admin');
        Route::post('/admin/{id}','edit')->name('edit-admin');
        Route::get('/admin/posts','showPosts')->name('showPosts');
        Route::get('/admin/notes','showNotes')->name('showNotes');
        Route::get('/admin/users','showusers')->name('showUsers');
        Route::get('/admin/category','showCategory')->name('showCategory');
        Route::get('/admin/comments','showComments')->name('showComment');
    });
    
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('/user', [AuthController::class, 'updateUser']);
});