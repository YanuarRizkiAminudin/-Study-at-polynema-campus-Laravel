<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\password;

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::all();   
        return view('user', ['data' => $user]); // Main
    }
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
        public function ubah($id)
        {
            $user = UserModel::find($id);
            return view('user_ubah', ['data' => $user]); // Main
        }

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

        public function ubah_simpan($id, Request $request){
            $user = UserModel::find($id);

            $user->username =$request->username;
            $user->nama = $request->nama;
            $user->password = Hash::make($request->password);
            $user->level_id = $request->level_id;
            
            $user->save();

            return redirect('/user');
        }
        public function hapus($id){
            $user = UserModel::find($id);
            $user->delete();

            return redirect('/user');
        }
    
}
