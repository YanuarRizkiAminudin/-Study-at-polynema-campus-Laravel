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
        $user = UserModel::firstWhere('level_id', 3);
        return view('user', ['data' => $user]);
    }
}
