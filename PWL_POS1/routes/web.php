<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Middleware\FirstMiddleware; //pertemuan 2
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PhotoController;

// Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile');

// Jobsheet 02 - PWL 2023/2024
// Route::get('/user/{name?}', function ($name='john'){
//     return 'Nama saya ' .$name;
// });
// // Route Name 
// Route::get(
//     '/user/profile', 
//     [UserProfileController::class, 'show']
// )->name('profile');

//Generating URLs...
// $url = route('profile');

// // Generating Redirects....
// return redirect() -> route('profile');
// //Route Grop dengan Middleware
Route::middleware([FirstMiddleware::class])->group(function(){
    Route::get('/adminlte/rahasia', function() {
        return 'Selamat datang di halaman rahasia!';
    });
});
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function() {
   return 'Home page dengan middleware first dan second';    
});
Route::get('/user/profile', function() {
    return 'User Profile page dengan middleware first dan second';
    });
});

//Route dengan Subdomain
Route::domain('{account}.example.com')->group(function () {
    Route::get('/user/{id}', function ($account, $id) {
        return "Akses subdomain: $account dengan ID pengguna: $id";
    });
});

//Route Middleware untuk Autentikasi
Route::middleware('auth')->group(function(){
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/post', [PostController::class, 'index']);
    Route::get('/event', [EventController::class, 'index']);
});

//Route Prefix untuk Admin
Route::prefix('admin')->group(function(){
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/post', [PostController::class, 'index']);
    Route::get('/event', [EventController::class, 'index']);
});
// Controller
Route::get('/hello', [WelcomeController::class,'hello']);
// Route::get('/', [PageController::class, 'index']);
// Route::get('/about', [PageController::class, 'about']);
// Route::get('/articles/{id}', [PageController::class,'articles']);
//Modifikasi
Route::get('/', HomeController::class);
Route::get('/about', AboutController::class);
Route::get('/articles/{id}', ArticleController::class);
//Resoutce Controller
Route::resource('photo', PhotoController::class);
