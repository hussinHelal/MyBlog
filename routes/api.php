<?php

//use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\user;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
// use App\Http\Controllers\LikeController;
use App\Http\Controllers\Auth\LoginController;

//Route::get('/', function () {
//    return response()->json(['message' => 'Hello world!']);
//});

Route::middleware('guest')->group(function () {
    Route::get('/loginapi', [AuthController::class, 'showLogin'])->name('loginapi');
    Route::post('/loginapi', [AuthController::class, 'login'])->name('login.submit');
    // Route::post('/login', [LoginController ::class, 'login'])->name('login.submit');
    Route::get('/registerapi', [AuthController::class, 'showRegister'])->name('registerapi');
    Route::post('/registerapi', [AuthController::class, 'register']);
});
// Route::middleware('guest')->group(function () {
//     Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
//     // Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
//     Route::post('/login', [LoginController ::class, 'login'])->name('login.submit');
//     Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
//     Route::post('/register', [AuthController::class, 'register']);

//     // Password reset
//     Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
//     Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
//     Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
//     Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
// });

// Email Verification
// Route::get('/email/verify', function () {
//     return view('auth.verify');
// })->middleware('auth:sanctum')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect()->route('index');
// })->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');

//Route::get('/forgot-password', function () {
//    return view('auth.forgot-password');
//})->middleware('guest')->name('password.request');
//
//Route::post('/forgot-password', function (Request $request) {
//    $request->validate(['email' => 'required|email']);
//
//    Password::sendResetLink($request->only('email'));
//
//    return back()->with('status', 'We sent a reset link if that email exists.');
//})->middleware('guest')->name('password.email');
//
//Route::get('/reset-password/{token}', function (string $token) {
//    return view('auth.reset', ['token' => $token]);
//})->middleware('guest')->name('password.reset');
//
//
//
//Route::get('/email/verify', function () {
//    return view('auth.verify'); // create this blade view yourself
//})->middleware('auth')->name('verification.notice');
//
//Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//    $request->fulfill(); // marks email as verified
//    return redirect()->route('index');
//})->middleware(['auth', 'signed'])->name('verification.verify');
//
//
//Route::post('/email/verification-notification', function (Request $request) {
//    $request->user()->sendEmailVerificationNotification();
//    return back()->with('message', 'Verification link sent!');
//})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
//

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/', [PostController::class, 'index'])->name('index');

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('postShow');
    Route::resource('/posts',PostController::class)->except(['store', 'update', 'destroy']);

//    Route::post('/post',[PostController::class,'store'])->middleware('can:store,post','role:admin,super_admin')->name('postStore');
//    Route::put('/post/{posts}',[PostController::class,'update'])->middleware('can:update,post','role:admin,super_admin')->name('postUpdate');
//    Route::delete('/post/{posts}',[PostController::class,'destroy'])->middleware('can:destroy,post','role:admin,super_admin')->name('postDestroy');
    Route::post('/post',[PostController::class,'store'])->middleware('can:create-post,App\Models\post')->name('postStore');
    Route::put('/post/{post}',[PostController::class,'update'])->middleware('can:update-post,post')->name('postUpdate');
    Route::delete('/post/{post}',[PostController::class,'destroy'])->middleware('can:destroy-post,post')->name('postDestroy');

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
        Route::get('/admin/users','showUsers')->name('showUsers');
        Route::get('/admin/category','showCategory')->name('showCategory');
        Route::get('/admin/comments','showComments')->name('showComment');
        Route::get('/admin/tags','showTags')->name('showTags');

        Route::get('/admin/user', [AuthController::class, 'index'])->name('dashboard.users.index');
        Route::post('/admin/user', [AuthController::class, 'store'])->name('dashboard.users.store');
        Route::put('/admin/user/{target}', [AuthController::class, 'update'])->name('dashboard.users.update');
        Route::delete('/admin/user/{target}', [AuthController::class, 'destroy'])->name('dashboard.users.destroy');
    });

    Route::resource('/user', User::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('/comments', CommentController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/tags', TagController::class);

    
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');


});
