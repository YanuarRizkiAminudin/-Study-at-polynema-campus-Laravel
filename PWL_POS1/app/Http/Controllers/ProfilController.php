<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Manalog\level;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;


class ProfilController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Profil User',
            'list' => ['Home', 'Profil', 'User']
        ];

        $page = (object) [
            'title' => 'Profil user'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('profil.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function import()
    {
        return view('profil.import');
    }

    public function store(Request $request)
    {
        // echo $request;
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg|max:2048',
        ]);
        
        // $imageName = time().'.'.$request->image->extension();  
         
        
        $id = Auth::id();
        $imageName = $id.'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $imageName);
        $request->image->move('adminlte/dist/img/', $imageName);
        $check = UserModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else{
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
            // return redirect('/');
        // echo $imageName;
        // /* 
        //     Write Code Here for
        //     Store $imageName name in DATABASE from HERE 
        // */
        
        // return back()->with('success', 'You have successfully uploaded an image.')->with('image', $imageName); 
    }






}
