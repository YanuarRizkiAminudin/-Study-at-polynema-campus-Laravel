<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\LevelModel;
use Yajra\DataTables\Facades\DataTables;


use function Laravel\Prompts\password;

class UserController extends Controller
{
    // public function index()
    // {
    //     // $user = UserModel::all(); 
    //     // Praktikum 2.7 – Relationships
    //     $user = UserModel::with('level')->get();
    //     //dd($user); 
    //     return view('user', ['data' => $user]); // Main
    // }
        // Tambah data level_id = 4 dulu, kalau belum ada
        // $cekLevel = DB::table('m_level')->where('level_id', 4)->first();
        // if (!$cekLevel) {
        //     DB::table('m_level')->insert([
        //         'level_id' => 4,
        //         'level_kode' => 'CST',
        //         'level_nama' => 'Customer'
        //     ]);
        // }

        // Tambah user jika belum ada
        // $cekUser = DB::table('m_user')->where('username', 'customer-1')->first();
        // if (!$cekUser) {
        //     $data = [
        //         'username' => 'customer-1',
        //         'nama' => 'Pelanggan',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 4
        //     ];
        //     UserModel::insert($data);
        // }
        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];

        // UserModel::where('username', 'customer-1')->update($data);

        // // Ambil semua data dari tabel user

        //PWL4
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_dua',
        //     'nama' => 'Manager 2',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);

        // $user = UserModel::all();
        // $user = UserModel::find(1);
        //$user = UserModel::where('level_id', 3)->first();
        //$user = UserModel::firstWhere('level_id', 3);

        // $user = UserModel::findOr(2,['username', 'nama'], function(){
        //     abort(404);
        // });

        //Praktikum 2.2 – Not Found Exceptions
        // $user = UserModel::findOrFail(1);

        //Praktikum 2.3 – Retreiving Aggregrates
        //$user =  UserModel::where('username','admin')->firstOrFail();
        // $user = UserModel::where('level_id', 2)->count();
        // dd($user);
        
        //$jumlahPengguna = UserModel::where('level_id',2)->count();
        //return view('user', ['jumlah' => $jumlahPengguna]);

        // $user =UserModel::firstOrCreate(
        //     [
        //         'username'=>'manager22',
        //         'nama'=> 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user =UserModel::firstOrNew(
        //     [
        //         'username'=>'manager',
        //         'nama'=> 'Manager',
        //     ],
        // );
        // $user =UserModel::firstOrNew(
        //     [
        //         'username'=>'manager33',
        //         'nama'=> 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user->save();
        // public function ubah($id)
        // {
        //     $user = UserModel::find($id);
        //     return view('user_ubah', ['data' => $user]); // Main
        // }

        //Praktikum 2.5 – Attribute Changes
        // $user = UserModel::create([
        //     'username' => 'manager14',
        //     'nama' => 'Manager14',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 3,
        // ]) ;
        // $user->username = 'manager14';

        // $user->isDirty();//true
        // $user->isDirty('username');//true
        // $user->isDirty('nama');//false
        // $user->isDirty(['nama', 'username']); //true

        // $user->isClean(); //false
        // $user->isClean('username');//true
        // $user->isClean('nama'); //true
        // $user->isClean(['nama', 'username']); //false

        // $user->save();//meyimpan

        // $user->isDirty(); //false
        // $user->isClean(); //true
        // dd($user->isDirty());

        // $user->wasChanged(); //true
        // $user->wasChanged('username'); //true
        // $user->wasChanged(['username','level_id']); //true
        // $user->wasChanged('nama'); //false
        // $user->wasChanged(['nama','username']);//true
        // dd($user->wasChanged(['nama', 'username']));//true

//         public function ubah_simpan($id, Request $request){
//             $user = UserModel::find($id);

//             $user->username =$request->username;
//             $user->nama = $request->nama;
//             $user->password = Hash::make($request->password);
//             $user->level_id = $request->level_id;
            
//             $user->save();

//             return redirect('/user');
//         }
//         public function hapus($id){
//             $user = UserModel::find($id);
//             $user->delete();

//             return redirect('/user');
//         }
    
// }
       // Menampilkan halaman awal user
       public function create()
       {
           $breadcrumb = (object) [
               'title' => 'Tambah User',
               'list' => ['Home', 'User', 'Tambah']
           ];
       
           $page = (object) [
               'title' => 'Tambah user baru'
           ];
       
           $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
           $activeMenu = 'user'; // set menu yang sedang aktif
       
           return view('user.create', [
               'breadcrumb' => $breadcrumb,
               'page' => $page,
               'level' => $level,
               'activeMenu' => $activeMenu
           ]);
       }
   
       // Menyimpan data user baru
   public function store(Request $request)
   {
       $request->validate([
           // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
           'username' => 'required|string|min:3|unique:m_user,username',
           'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
           'password' => 'required|min:5', // password harus diisi dan minimal 5 karakter
           'level_id' => 'required|integer' // level_id harus diisi dan berupa angka
       ]);
   
       UserModel::create([
           'username' => $request->username,
           'nama' => $request->nama,
           'password' => bcrypt($request->password), // password dienkripsi sebelum disimpan
           'level_id' => $request->level_id
       ]);
   
       return redirect('/user')->with('success', 'Data user berhasil disimpan');
   } 
   // Menampilkan detail user
   public function show(string $id)
   {
       $user = UserModel::with('level')->find($id);
   
       $breadcrumb = (object) [
           'title' => 'Detail User',
           'list' => ['Home', 'User', 'Detail']
       ];
   
       $page = (object) [
           'title' => 'Detail user'
       ];
   
       $activeMenu = 'user'; // set menu yang sedang aktif
   
       return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
   }   
       public function index()
       {
           $breadcrumb = (object) [
               'title' => 'Daftar User',
               'list' => ['Home', 'User',]
           ];
   
           $page = (object) [
               'title' => 'Daftar user yang terdaftar dalam sistem'
           ];
   
           $activeMenu = 'user'; // set menu yang sedang aktif
           $level =LevelModel::all();
           return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'level'=>$level, 'activeMenu' => $activeMenu]); 
       }
       
       // Ambil data user dalam bentuk json untuk datatables
   public function list(Request $request)
   {
       $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
           ->with('level');
   
           if($request->level_id){
               $users->where('level_id', $request->level_id);
           }
   
       return DataTables::of(source: $users)
           // menambahkan kolom index / no urut (default nama kolom: DT RowIndex)
           ->addIndexColumn()
           ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
               $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a>';
               $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>';
               $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
                   . csrf_field() . method_field('DELETE') .
                   '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
               return $btn;
           })
           ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
           ->make(true);
   }// Menampilkan halaman form edit user
   public function edit(string $id)
   {
       $user = UserModel::find($id);
       $level = LevelModel::all();
   
       $breadcrumb = (object) [
           'title' => 'Edit User',
           'list' => ['Home', 'User', 'Edit']
       ];
   
       $page = (object) [
           'title' => 'Edit user'
       ];
   
       $activeMenu = 'user'; // set menu yang sedang aktif
   
       return view('user.edit', [
           'breadcrumb' => $breadcrumb,
           'page' => $page,
           'user' => $user,
           'level' => $level,
           'activeMenu' => $activeMenu
       ]);
   }
   
   // Menyimpan perubahan data user
   public function update(Request $request, string $id)
   {
       $request->validate([
           // username harus diisi, berupa string, minimal 3 karakter,
           // dan bernilai unik di tabel m_user kolom username kecuali untuk user dengan id yang sedang diedit
           'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
           'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
           'password' => 'nullable|min:5', // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
           'level_id' => 'required|integer' // level_id harus diisi dan berupa angka
       ]);
   
       $user = UserModel::find($id);
       $user->update([
           'username' => $request->username,
           'nama' => $request->nama,
           'password' => $request->password ? bcrypt($request->password) : $user->password,
           'level_id' => $request->level_id
       ]);
   
       return redirect('/user')->with('success', 'Data user berhasil diubah');
   }
   // Menghapus data user
   public function destroy(string $id)
   {
       $check = UserModel::find($id);
       if (!$check) {
           // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
           return redirect('/user')->with('error', 'Data user tidak ditemukan');
       }
   
       try {
           UserModel::destroy($id); // Hapus data level
           return redirect('/user')->with('success', 'Data user berhasil dihapus');
       } catch (\Illuminate\Database\QueryException $e) {
           // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
           return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
       }
   }
   
   }