<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Js;
class UserController extends Controller
{
    public function index()
    {
        //$data = [
            //'level_id' => 2,
            //'username' => 'manager_tiga',
            //'nama' => 'Manager 3',
            //'password' => Hash::make('12345')
        //];
        //UserModel::create($data);

        //$user = UserModel::where('level_id',2)->first();
        //$user = UserModel::firstWhere('level_id',5);
//===========================================================//
        //$user = UserModel::findOr(1,['username','nama'], function(){
            //abort(404);
        //});
        
        //$user = UserModel::findOrFail(1);
       //$user = UserModel::where('username', 'admin')->firstOrFail();
    //}
    //===========================================================//
       //public function someMethod()
    //{
        //$min = UserModel::where('active', 1)->count();
        //dd($min);
        //return view('user', ['data' => $min]);
    //===========================================================//
    //    $user = UserModel::where('level_id',4)->count();
    //    dd($user);
    //     return view('user', ['data' => $user]);

            //$user = UserModel::where('level_id', 1)->count();
      //===========================================================//
            //$user = UserModel::firstOrCreate(
              //  [
                //    'username' => 'manager_empat',
                  //  'nama' => 'Manager 4',
                    //'password' => Hash::make('12345'),
                    //'level_id' => 2
                //]
            //);
            //===========================================================//
           // $user = UserModel::firstOrNew(
             //   [
               //     'username' => 'manager44',
                 //   'nama' => 'Minggu 4 4',
                   // 'password' => Hash::make('12345'),
                    //'level_id' => 2
                //]
            //);
            //$user->save();
            //return view('user', ['data' => $user]); // Mengirimkan data pengguna ke view
             //===========================================================//
        //$user = UserModel::Create([
          //  'username' => 'manager24',
            //'nama' => 'manager19',
            //'password' => Hash::make('123452'),
            //'level_id' => 2,
        //]);
        //$user->username = 'manager34';

        //$user->isDirty(); //true
        //$user->isDirty('username');//true
        //$user->isDirty('nama');//false
        //$user->isDirty(['nama', 'username']);//true

        //$user->isClean(); //false
        //$user->isClean('username');//false
        //$user->isClean('nama');//true
        //$user->isClean(['nama', 'username']);//false

        //$user->isDirty();//false
        //$user->save();
        //$user->isClean();//true
        //dd($user->isDirty());
        //dd($user->isClean());
        //===========================================================//
        //$user = UserModel::Create([
          //'username' => 'manager24',
          //'nama' => 'manager19',
          //'password' => Hash::make('123452'),
          //'level_id' => 2,
      //]);
      //$user->username = 'manager34';
        //$user->wasChanged();//true
        //$user->wasChanged('username');//true
        //$user->wasChanged(['username','level_id']);//true
        //$user->wasChanged('nama');//false
        //dd($user->wasChanged(['nama','username']));//true
        //===========================================================//
     //   $user = UserModel::all();
      //  return view('user',['data'=> $user]);
      $user = UserModel::where('level_id', 2)->count();
      $user = UserModel::with('level')->get();

      return view('user', ['data' => $user]);
   }

    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->level_id
        ]);
        return redirect('/user');
    }

    public function ubah($id)
    {
        $user = UserModel::find($id);
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
}