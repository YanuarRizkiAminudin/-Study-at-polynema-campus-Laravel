<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        //$user = UserModel::findOr(1,['username','nama'], function(){
            //abort(404);
        //});
        //$user = UserModel::findOrFail(1);
       //$user = UserModel::where('username', 'admin')->firstOrFail();
    //}
       //public function someMethod()
    //{
        //$min = UserModel::where('active', 1)->count();
        //dd($min);
        //return view('user', ['data' => $min]);
    
    //    $user = UserModel::where('level_id',4)->count();
    //    dd($user);
    //     return view('user', ['data' => $user]);

            //$user = UserModel::where('level_id', 1)->count();
      
            //$user = UserModel::firstOrCreate(
              //  [
                //    'username' => 'manager_empat',
                  //  'nama' => 'Manager 4',
                    //'password' => Hash::make('12345'),
                    //'level_id' => 2
                //]
            //);
            $user = UserModel::firstOrNew(
                [
                    'username' => 'manager44',
                    'nama' => 'Minggu 4 4',
                    'password' => Hash::make('12345'),
                    'level_id' => 2
                ]
            );
            $user->save();
            return view('user', ['data' => $user]); // Mengirimkan data pengguna ke view
        }
}
