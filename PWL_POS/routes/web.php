<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Controller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// =========== Jobsheet 3 ============
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);

// =========== Jobsheet 2 ===========
Route::get('/', function () {
    return view('welcome');
});

//Route ini digunakan untuk homepage
Route::get('/', [HomeController::class, 'index']);

// Route ini digunakan untuk halaman produk
Route::prefix('category')->group(function () {
    Route::get('/food-beverage', [ProductController::class, 'foodBeverage']);
    Route::get('/beauty-health', [ProductController::class, 'beautyHealth']);
    Route::get('/home-care', [ProductController::class, 'homeCare']);
    Route::get('/baby-kid', [ProductController::class, 'babyKid']);
    });

// Route ini digunakan untuk user dengan parameter
Route::get('/user/{id}/name/{name}', [UserController::class, 'profile']);

// Route ini digunakan untuk halaman penjualan
Route::get('/sales', [SalesController::class, 'index']);