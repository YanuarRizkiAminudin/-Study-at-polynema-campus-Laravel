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

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
//js7
use App\Http\Controllers\AuthController;
use App\Models\Level;




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
Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function(){
    Route::get('/', [WelcomeController::class, 'index']);
    

// Route Level
// Artinya semua route di dalam group ini harus punya role ADM (Administrator)
Route::middleware(['authorize:ADM'])->group(function () {
    Route::get('/level', [LevelController::class, 'index']);
    Route::post('/level/list', [LevelController::class, 'list']); // untuk list json datatables
    Route::get('/level/create', [LevelController::class, 'create']);
    Route::post('/level', [LevelController::class, 'store']);
    Route::get('/level/{id}/edit', [LevelController::class, 'edit']); // untuk tampilan form edit
    Route::put('/level/{id}', [LevelController::class, 'update']); // untuk proses update data
    Route::delete('/level/{id}', [LevelController::class, 'destroy']);
    Route::get('/level/{id}/show_ajax', [LevelController::class, 'show_ajax']);         // detail ajax
    Route::get('/level/import', [LevelController::class, 'import']); // ajax form upload excel
    Route::post('/level/import_ajax', [LevelController::class, 'import_ajax']); // ajax import excel
    Route::get('/level/export_excel', [LevelController::class, 'export_excel']); // export excel
    Route::get('/level/export_pdf', [LevelController::class, 'export_pdf']); // export pdf
});
// Artinya semua route di dalam group ini harus punya role MNG (Manager)
Route::middleware(['authorize:MNG'])->group(function () {
    Route::get('/level', [LevelController::class, 'index']);
    Route::post('/level/list', [LevelController::class, 'list']); // untuk list json datatables
    Route::get('/level/create', [LevelController::class, 'create']);
    Route::post('/level', [LevelController::class, 'store']);
    Route::get('/level/{id}/edit', [LevelController::class, 'edit']); // untuk tampilan form edit
    Route::put('/level/{id}', [LevelController::class, 'update']); // untuk proses update data
    Route::delete('/level/{id}', [LevelController::class, 'destroy']);
    Route::get('/level/{id}/show_ajax', [LevelController::class, 'show_ajax']);         // detail ajax
});

// Artinya semua route di dalam group ini harus punya role ADM (Administrator) atau MNG (Manager)
Route::middleware(['authorize:ADM,MNG'])->group(function () {
    Route::get('/level', [LevelController::class, 'index']);
    Route::post('/level/list', [LevelController::class, 'list']); // untuk list json datatables
    Route::get('/level/create', [LevelController::class, 'create']);
    Route::post('/level', [LevelController::class, 'store']);
    Route::get('/level/{id}/edit', [LevelController::class, 'edit']); // untuk tampilan form edit
    Route::put('/level/{id}', [LevelController::class, 'update']); // untuk proses update data
    Route::delete('/level/{id}', [LevelController::class, 'destroy']);
    Route::get('/level/{id}/show_ajax', [LevelController::class, 'show_ajax']);         // detail ajax
});

// Route Barang
// Artinya semua route di dalam group ini harus punya role ADM (Administrator)
Route::middleware(['authorize:ADM'])->group(function () {
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/list', [BarangController::class, 'list']);
    Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // ajax form create
    Route::post('/barang_ajax', [BarangController::class, 'store_ajax']); // ajax store
    Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // ajax form edit
    Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // ajax update
    Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // ajax form confirm delete
    Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // ajax delete
    Route::get('/barang/{id}/show_ajax', [BarangController::class, 'show_ajax']);         // detail ajax
    Route::get('/barang/import',[BarangController::class, 'import']); //ajax form upload excel
    Route::post('/barang/import_ajax',[BarangController::class, 'import_ajax']);// ajax import excel
    Route::get('/barang/export_excel',[BarangController::class, 'export_excel']); //export excel
    Route::get('/barang/export_pdf',[BarangController::class,'export_pdf']); // export pdf
});
// Artinya semua route di dalam group ini harus punya role MNG (Manager)
Route::middleware(['authorize:MNG'])->group(function () {
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/list', [BarangController::class, 'list']);
    Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // ajax form create
    Route::post('/barang_ajax', [BarangController::class, 'store_ajax']); // ajax store
    Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // ajax form edit
    Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // ajax update
    Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // ajax form confirm delete
    Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // ajax delete
    Route::get('/barang/{id}/show_ajax', [BarangController::class, 'show_ajax']);         // detail ajax
});
Route::middleware(['authorize:ADM,MNG'])->group(function () {
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/list', [BarangController::class, 'list']);
    Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // ajax form create
    Route::post('/barang_ajax', [BarangController::class, 'store_ajax']); // ajax store
    Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // ajax form edit
    Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // ajax update
    Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // ajax form confirm delete
    Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // ajax delete
    Route::get('/barang/{id}/show_ajax', [BarangController::class, 'show_ajax']);         // detail ajax
    
});
//Route::get('/', [WelcomeController::class, 'index']);

// Semua route user ini hanya bisa diakses oleh role ADM (Administrator)
Route::middleware(['authorize:ADM'])->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);                       // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);                  // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);              // menampilkan halaman form tambah user
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);    // menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']);           // menyimpan data user Ajax
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);   // menampilkan halaman form edit user ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // menampilkan halaman konfirmasi hapus user ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user ajax
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);         // detail ajax
    Route::get('/import', [UserController::class, 'import']); // ajax form upload excel
    Route::post('/import_ajax', [UserController::class, 'import_ajax']); // ajax import excel
    Route::get('/export_excel', [UserController::class, 'export_excel']); // export excel
    Route::get('/export_pdf', [UserController::class, 'export_pdf']); // export pdf
});

// Semua route user ini hanya bisa diakses oleh role MNG (Manage)
Route::middleware(['authorize:MNG'])->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);                       // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);                  // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);              // menampilkan halaman form tambah user
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);    // menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']);           // menyimpan data user Ajax
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);   // menampilkan halaman form edit user ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // menampilkan halaman konfirmasi hapus user ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user ajax
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);         // detail ajax
});
// Semua route user ini hanya bisa diakses oleh role ADM,MNG (Administrator, Manager)
Route::middleware(['authorize:ADM,MNG'])->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);                       // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);                  // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);              // menampilkan halaman form tambah user
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);    // menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']);           // menyimpan data user Ajax
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);   // menampilkan halaman form edit user ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // menampilkan halaman konfirmasi hapus user ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user ajax
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);         // detail ajax
});
//Route::group(['prefix' => 'user'],function() {
//Route::post('/', [UserController::class, 'store']);              // menyimpan data user baru
//Route::get('/{id}', [UserController::class, 'show']);             // menampilkan detail user
//Route::get('/{id}/edit', [UserController::class, 'edit']);        // menampilkan halaman form edit user
//Route::put('/{id}', [UserController::class, 'update']);            // menyimpan perubahan data user
//Route::delete('/{id}', [UserController::class, 'destroy']);        // menghapus data user
//Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);  //menamilkan halaman form confirm user ajax


// Semua route supplier ini hanya bisa diakses oleh role ADM (Administrator)
Route::middleware(['authorize:ADM'])->prefix('supplier')->group(function () {
    Route::get('/', [SupplierController::class, 'index']);                           // menampilkan halaman awal supplier
    Route::post('/list', [SupplierController::class, 'list']);                       // menampilkan data supplier untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);                   // menampilkan form tambah supplier
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);          // form tambah supplier ajax
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);                // simpan supplier ajax
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);         // form edit ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);     // simpan perubahan ajax                
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);    // konfirmasi hapus ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);  // hapus ajax
    Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);         // detail ajax
    Route::get('/import', [SupplierController::class, 'import']); // ajax form upload excel
    Route::post('/import_ajax', [SupplierController::class, 'import_ajax']); // ajax import excel
    Route::get('/export_excel', [SupplierController::class, 'export_excel']); // export excel
    Route::get('/export_pdf', [SupplierController::class, 'export_pdf']); // export pdf
});
// Semua route supplier ini hanya bisa diakses oleh role MNG (Manager)
Route::middleware(['authorize:MNG'])->prefix('supplier')->group(function () {
    Route::get('/', [SupplierController::class, 'index']);                           // menampilkan halaman awal supplier
    Route::post('/list', [SupplierController::class, 'list']);                       // menampilkan data supplier untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);                   // menampilkan form tambah supplier
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);          // form tambah supplier ajax
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);                // simpan supplier ajax
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);         // form edit ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);     // simpan perubahan ajax                
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);    // konfirmasi hapus ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);  // hapus ajax
    Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);         // detail ajax
});
// Semua route supplier ini hanya bisa diakses oleh role ADM (Administrator)
Route::middleware(['authorize:ADM,MNG'])->prefix('supplier')->group(function () {
    Route::get('/', [SupplierController::class, 'index']);                           // menampilkan halaman awal supplier
    Route::post('/list', [SupplierController::class, 'list']);                       // menampilkan data supplier untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);                   // menampilkan form tambah supplier
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);          // form tambah supplier ajax
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);                // simpan supplier ajax
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);         // form edit ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);     // simpan perubahan ajax
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);    // konfirmasi hapus ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);  // hapus ajax
    Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);         // detail ajax
});

// Semua route kategori ini hanya bisa diakses oleh role ADM (Administrator)
Route::middleware(['authorize:ADM'])->prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index']);                           // halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']);                       // data untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);                   // form tambah kategori
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);          // form tambah ajax
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);         // form edit ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);     // update ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);    // konfirmasi hapus ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);  // hapus ajax
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);         // detail ajax
    Route::get('/import', [KategoriController::class, 'import']); // ajax form upload excel
    Route::post('/import_ajax', [KategoriController::class, 'import_ajax']); // ajax import excel
    Route::get('/export_excel', [KategoriController::class, 'export_excel']); // export excel
    Route::get('/export_pdf', [KategoriController::class, 'export_pdf']); // export pdf
});
// Semua route kategori ini hanya bisa diakses oleh role ADM (Administrator)
Route::middleware(['authorize:ADM'])->prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index']);                           // halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']);                       // data untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);                   // form tambah kategori
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);          // form tambah ajax
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);         // form edit ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);     // update ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);    // konfirmasi hapus ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);  // hapus ajax
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);         // detail ajax
});
// Semua route kategori ini hanya bisa diakses oleh role ADM (Administrator)
Route::middleware(['authorize:ADM'])->prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index']);                           // halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']);                       // data untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);                   // form tambah kategori
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);          // form tambah ajax
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);         // form edit ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);     // update ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);    // konfirmasi hapus ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);  // hapus ajax
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);         // detail ajax
});
});
