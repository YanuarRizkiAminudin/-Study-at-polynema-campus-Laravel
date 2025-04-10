<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Baris ini penting untuk menggunakan Hash

class UserController extends Controller
{
    /**public function index()
    {
        // tambah data user dengan Eloquent Model
        $data = [
            'username' => 'customer-1',
            'nama' => 'Pelanggan',
            'password' => Hash::make('12345'), // Baris ini menggunakan Hash untuk mengenkripsi password
            'level_id' => 4
        ];
        UserModel::insert($data); // tambahkan data ke tabel m_user

        // coba akses model UserModel
        $user = UserModel::all(); // ambil semua data dari tabel m_user
        return view('user', ['data' => $user]);
    }
}*/
public function index()
{
    // tambah data user dengan Eloquent Model
    $data = [
        'nama' => 'Pelanggan Pertama',
    ];
    UserModel::where('username', 'customer-1')->update($data); // update data user

    // coba akses model UserModel
    $user = UserModel::all(); // ambil semua data dari tabel m_user
    return view('user', ['data' => $user]);
}
}