<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\user;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
 use App\Http\Controllers\LikeController;
// use App\Http\Controllers\Auth\LoginController;

//Route::get('/', function () {
//    return response()->json(['message' => 'Hello world!']);
//});

Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/', [PostController::class, 'index'])->name('index');

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('postShow');
    Route::resource('/posts',PostController::class);
    Route::get('/posts/category/{category}', [PostController::class, 'category'])->name('posts.category');
    Route::get('/posts/tag/{tag}', [PostController::class, 'tag'])->name('posts.tag');
    Route::get('/posts/author/{user}', [PostController::class, 'author'])->name('posts.author');


    Route::post('/like', [PostController::class, 'addLike'])->name('addLike');
    Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->name('comments.store');
    Route::delete('/comments/{comment}', [PostController::class, 'destroyComment'])->name('comments.destroy');


    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin','index')->name('admin');
        Route::post('/admin/{id}','edit')->name('edit-admin');
        Route::get('/admin/posts','showPosts')->name('showPosts');
        Route::get('/admin/users','showusers')->name('showUsers');
        Route::get('/admin/category','showCategory')->name('showCategory');
        Route::get('/admin/comments','showComments')->name('showComment');
        Route::get('/admin/tags','showTags')->name('showTags');
    });

    Route::resource('/user', User::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('/comments', CommentController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/tags', TagController::class);
});
