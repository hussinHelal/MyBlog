<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NotesController;

//Route::get('/', function () {
//    return response()->json(['message' => 'Hello world!']);
//});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/user', [AuthController::class, 'updateUser']);

});



Route::get('/', [PostController::class, 'index']);
Route::post('/posts/{post}', [PostController::class, 'show']);
Route::resource('/posts',PostController::class);

Route::get('/notes',[NotesController::class,'index']);
Route::resource('/notes',NotesController::class);

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin','index');
    Route::post('/admin/{id}','edit');
});