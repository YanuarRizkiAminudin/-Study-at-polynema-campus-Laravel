<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| Di sini Anda bisa menambahkan route untuk aplikasi Anda.
| Route ini akan dimuat oleh RouteServiceProvider dan akan 
| diberi middleware "web".
*/

Route::get('/', function () {
    return view('welcome');  // Menampilkan halaman welcome saat mengakses '/'
});

Route::resource('items', ItemController::class);  // Menyediakan route untuk CRUD items menggunakan ItemController
