<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //public function profile($id, $name) {
        //return view('user.profile', ['id' => $id, 'name' => $name]);
    //}

    //public function index() {
        // coba akses model UserModel
        //$user = UserModel::all(); //ambil semua data dari tabel m_user
        //return view('user', ['data' => $user]);
    //}

    //public function index() {
        // tambah data user dengan Eloquent Model
            //$data = [
                //'username' => 'customer-1',
                //'nama' => 'Pelanggan',
                //'password' => Hash::make('12345'), // Perbaikan: tambahkan spasi setelah Hash::
                //'level_id' => 5
            //];
    
            //UserModel::insert($data); // tambahkan data ke tabel m_user
    
            // coba akses model UserModel
            //$user = UserModel::all(); // ambil semua data dari tabel m_user
            //return view('user', ['data' => $user]);
        //}

        // Jobsheet 3
        //public function index() {
            // tambah data user dengan Eloquent Model
                //$data = [
                    //'nama' => 'Pelanggan Pertama',
                //];
        
                //UserModel::where('username', 'customer-1')->update($data); // update data ke tabel m_user
        
                // coba akses model UserModel
                //$user = UserModel::all(); // ambil semua data dari tabel m_user
                //return view('user', ['data' => $user]);
            //}

        // Jobsheet 4 Praktikum 1
        //public function index() {
            // tambah data user dengan Eloquent Model
                //$data = [
                    //'level_id' => '2',
                    //'username' => 'manager_tiga',
                    //'nama' => 'Manager 3',
                    //'password' => Hash::make('12345')
                //];
        
                //UserModel::create($data); 
        
                // coba akses model UserModel
                //$user = UserModel::all();
                //return view('user', ['data' => $user]);
            //}

        // Jobsheet 4 Praktikum 2.1 Nomor 1
        //public function index() {
            //$user = UserModel::find(1);
            //return view('user', ['data' => $user]);
        //}

        // Jobsheet 4 Praktikum 2.1 Nomor 4
        //public function index() {
            //$user = UserModel::where('level_id', 1)->first();
            //return view('user', ['data' => $user]);
        //}

        // Jobsheet 4 Praktikum 2.1 Nomor 6
        //public function index() {
            //$user = UserModel::firstWhere('level_id', 1)->first();
            //return view('user', ['data' => $user]);
                //}

        // Jobsheet 4 Praktikum 2.1 Nomor 8
        //public function index() {
            //$user = UserModel::findOr(1, ['username', 'nama'], function () {
                //abort(404);
            //});
            //return view('user', ['data' => $user]);
                //}

        // Jobsheet 4 Praktikum 2.1 Nomor 10
        //public function index() {
            //$user = UserModel::findOr(20, ['username', 'nama'], function () {
                //abort(404);
            //});
            //return view('user', ['data' => $user]);
                //}

        // Jobsheet 4 Praktikum 2.2 Nomor 1
        //public function index() {
            //$user = UserModel::findOrFail(1);
            //return view('user', ['data' => $user]);
            //}

        // Jobsheet 4 Praktikum 2.2 Nomor 3
        //public function index() {
           //$user = UserModel::where('username', 'manager9')->firstOrFail();
            //return view('user', ['data' => $user]);
           // }

        // Jobsheet 4 Praktikum 2.3 Nomor 1
        //public function index() {
            //$user = UserModel::where('level_id', 2)->count();
            //dd($user);
            //return view('user', ['data' => $user]);
            //}

        // Jobsheet 4 Praktikum 2.3 Nomor 3
        //public function index() {
            //$userCount = UserModel::where('level_id', 2)->count();
            //return view('user', ['data' => $userCount]);
        //}

        // Jobsheet 4 Praktikum 2.4 Nomor 1
        //public function index() {
            //$user = UserModel::firstOrCreate(
                //[
                    //'username' => 'manager',
                    //'nama' => 'Manager',
                //],
            //);
            //return view('user', ['data' => $user]);
        //}

        // Jobsheet 4 Praktikum 2.4 Nomor 4
        //public function index() {
            //$user = UserModel::firstOrCreate(
                //[
                    //'username' => 'manager22',
                    //'nama' => 'Manager Dua Dua',
                    //'password' => Hash::make('12345'),
                    //'level_id' => 2,
                //],
            //);
            //return view('user', ['data' => $user]);
        //}

        // Jobsheet 4 Praktikum 2.4 Nomor 6
        //public function index() {
            //$user = UserModel::firstOrNew(
                //[
                    //'username' => 'manager',
                    //'nama' => 'Manager',
                //],
            //);
            //return view('user', ['data' => $user]);
        //}

        // Jobsheet 4 Praktikum 2.4 Nomor 8
        //public function index() {
            //$user = UserModel::firstOrNew(
                //[
                    //'username' => 'manager33',
                    //'nama' => 'Manager Tiga Tiga',
                    //'password' => Hash::make('12345'),
                    //'level_id' => 2,
                //],
            //);
            //return view('user', ['data' => $user]);
        //}

        // Jobsheet 4 Praktikum 2.4 Nomor 10
        //public function index() {
            //$user = UserModel::firstOrNew(
                //[
                    //'username' => 'manager33',
                    //'nama' => 'Manager Tiga Tiga',
                    //'password' => Hash::make('12345'),
                    //'level_id' => 2,
                //],
            //);
            //$user->save();

            //return view('user', ['data' => $user]);
        //}

        // Jobsheet 4 Praktikum 2.5 Nomor 1
        //public function index() {
            //$user = UserModel::create(
                //[
                    //'username' => 'manager55',
                    //'nama' => 'Manager55',
                    //'password' => Hash::make('12345'),
                    //'level_id' => 2
                //],
            //);
            //$user->username = 'manager56';
    
            //$user->isDirty();
            //$user->isDirty('username');
            //$user->isDirty('nama');
            //$user->isDirty(['nama', 'username']);
    
            //$user->isClean();
            //$user->isClean('username');
            //$user->isClean('nama');
            //$user->isClean(['nama', 'username']);
    
            //$user->save();
    
            //$user->isDirty();
            //$user->isClean();
            //dd($user->isDirty());
        //}

         // Jobsheet 4 Praktikum 2.5 Nomor 3
         //public function index() {
            //$user = UserModel::create(
                //[
                    //'username' => 'manager11',
                    //'nama' => 'Manager11',
                    //'password' => Hash::make('12345'),
                    //'level_id' => 2,
                //]);

            //$user->username = 'manager12';
    
            //$user->save();
    
            //$user->wasChanged();
            //$user->wasChanged('username');
            //$user->wasChanged(['username', 'level_id']);
            //$user->wasChanged('nama');
            //dd($user->wasChanged(['nama', 'username']));
        //}

        // Jobsheet 4 Praktikum 2.6 Nomor 2
        //public function index() {
            //$user = UserModel::all();
            //return view('user', ['data' => $user]);
        //}

        public function tambah() {
            return view('user_tambah');
        }

        public function tambah_simpan(Request $request) 
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->level_id,
        ]);
        return redirect('/user');
    }

    public function ubah($id) 
    {
        $user = UserModel::find(($id));
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');

    }

    // Jobsheet 4 Praktikum 2.7 Nomor 2
    //public function index() {
        //$user = UserModel::with('level')->get();
        //dd($user);
    //}

    // Jobsheet 4 Praktikum 2.7 Nomor 4
    public function index() {
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }

}

