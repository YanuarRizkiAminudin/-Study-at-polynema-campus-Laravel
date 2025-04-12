<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
//3
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\WelcomeController;

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

//Route::get('/',[HomeController::class, 'index'])->name('home');

// Route::prefix('category')->group(function(){
//     Route::get('food-beverage', [ProductController::class, 'foodBeverage']);
//     Route::get('beauty-health',[ProductController::class, 'beautyHealth']);
//     Route::get('home-care',[ProductController::class, 'homeCare']);
//     Route::get('baby-kid', [ProductController::class, 'babyKid']);
// });

// Route::get('/user/{id}/name/{name}', [UserController::class, 'profile']);

// Route::get('/sales', [SalesController::class, 'index'])->name('sales');

// //Jobshet 3 | 4 Implementasi DB Facade
// Route::get('/', function(){
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);
// //Praktikum 2.6 – Create, Read, Update, Delete (CRUD)
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

//Js 5
Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'],function() {
Route::get('/', [UserController::class, 'index']);               // menampilkan halaman awal user
Route::post('/list', [UserController::class, 'list']);            // menampilkan data user dalam bentuk json untuk datatables
Route::get('/create', [UserController::class, 'create']);         // menampilkan halaman form tambah user
Route::post('/', [UserController::class, 'store']);              // menyimpan data user baru
Route::get('/{id}', [UserController::class, 'show']);             // menampilkan detail user
Route::get('/{id}/edit', [UserController::class, 'edit']);        // menampilkan halaman form edit user
Route::put('/{id}', [UserController::class, 'update']);            // menyimpan perubahan data user
Route::delete('/{id}', [UserController::class, 'destroy']);        // menghapus data user
});


Route::group(['prefix' => 'supplier'], function() {
Route::get('/', [SupplierController::class, 'index']);          //menampilkan halaman awal supplier
Route::post('/list', [SupplierController::class, 'list']);      //menampilkan data supplier dalam bentuk json untuk datatables
Route::get('/create', [SupplierController::class, 'create']);   //menampilkan halaman form tambah supplier
Route::post('/', [SupplierController::class, 'store']);         //menyimpan data supplier baru
Route::get('/{id}', [SupplierController::class, 'show']);       //menampilkan detail supplier
Route::get('/{id}/edit', [SupplierController::class, 'edit']);  //menamilkan halaman form edit supplier
Route::put('/{id}', [SupplierController::class, 'update']);     //menyimpan perubahan data supplier
Route::delete('/{id}', [SupplierController::class, 'destroy']); //menghapus data supplier
});