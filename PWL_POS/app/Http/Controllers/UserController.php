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

            // Mengambil jumlah user dengan level_id 4
            $user = UserModel::where('level_id', 1)->count();
      
            // Mengirimkan jumlah user ke view
            return view('user', ['data' => $user]);
    }
}
