<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () { // artinya semua route di dalam group ini harus login dulu
    // masukkan semua route yang perlu autentikasi di sini
});

// // artinya semua route di dalam group ini harus punya role ADM (Administrator)
// Route::middleware(['authorize:ADM'])->group(function () {
//     Route::get('/barang', [BarangController::class, 'index']);
//     Route::post('/barang/list', [BarangController::class, 'list']);
//     Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // ajax form create
//     Route::post('/barang/store_ajax', [BarangController::class, 'store_ajax']); // ajax store
//     Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // ajax form edit
//     Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // ajax update
//     Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_delete_ajax']); // ajax form confirm delete
//     Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // ajax delete
// });

// // artinya semua route di dalam group ini harus punya role MNG (Manager)
// Route::middleware(['authorize:MNG'])->group(function () {
//     Route::get('/barang', [BarangController::class, 'index']);
//     Route::post('/barang/list', [BarangController::class, 'list']);
//     Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // ajax form create
//     Route::post('/barang/store_ajax', [BarangController::class, 'store_ajax']); // ajax store
//     Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // ajax form edit
//     Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // ajax update
//     Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_delete_ajax']); // ajax form confirm delete
//     Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // ajax delete
// });

// artinya semua route di dalam group ini harus punya role ADM (Administrator) dan MNG (Manager)
Route::middleware(['authorize:ADM,MNG'])->group(function () {
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/list', [BarangController::class, 'list']);
    Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // ajax form create
    Route::post('/barang/store_ajax', [BarangController::class, 'store_ajax']); // ajax store
    Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // ajax form edit
    Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // ajax update
    Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_delete_ajax']); // ajax form confirm
    Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // ajax delete
});