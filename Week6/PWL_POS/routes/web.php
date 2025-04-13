<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Jobsheet 6 Prak-1 No-6
// Route User
Route::group(['prefix' => 'user'], function() {
    Route::get('/', [UserController::class, 'index']);          // Menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      // Menampilkan data user dalam bentuk JSON untuk DataTables
    Route::get('/create', [UserController::class, 'create']);   // Menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);         // Menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);     // Menampilkan halaman form tambah user AJAX
    Route::post('/ajax', [UserController::class, 'store_ajax']);           // Menyimpan data user baru AJAX
    Route::get('/{id}', [UserController::class, 'show']);       // Menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // Menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     // Menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);       // Menampilkan halaman form edit user AJAX
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);   // Menyimpan perubahan data user AJAX
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);  // Menampilkan form konfirmasi hapus user AJAX
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Menghapus data user AJAX
    Route::delete('/{id}', [UserController::class, 'destroy']); // Menghapus data user
});
