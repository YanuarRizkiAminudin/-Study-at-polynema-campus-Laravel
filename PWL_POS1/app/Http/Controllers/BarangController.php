<?php
namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel'
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller {

    // menampilkan halaman awal user
    public function index(){

        $breadrumb = (object)[
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object)[
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $ativeMenu ='barang'; // set menu yang sedang aktif

        $kategori = KategoriModel::all(); //ambil data kategori untuk filter kategori

        return view('barang.index',['breadcrumb' => $breadrumb, 'page' => $page, 'kategori', 'activeMenu' => $activeMenu ]);
    }

    //Ambil data barang dalam betuk json untuk database
    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'kategori_id')
        ->with('kategori');

        //filter data user berdasarkan kategori_id
        if($request->kategori_id) {
            $barangs->where('kategori_id', $request->kategori_id); 
        }
        return DataTables::of($barngs)
        //menambahkan kolom index / no urut(defaut nama kolom: DT_RowIndex)
        ->addIndexolumn()
        ->aaddColum('aksi', function ($barang){
            $btn = '<a href="'.url('/barang' .$barang->barang_id) . 'btn btn-infp btn"'
        })
    }
}