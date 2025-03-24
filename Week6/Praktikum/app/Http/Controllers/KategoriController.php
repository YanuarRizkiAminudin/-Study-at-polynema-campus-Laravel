<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    // Menampilkan halaman awal Kategori
    public function create()
    {
        $kategoris = KategoriModel::select('kategori_id', 'kategori_nama')->get();
        return view('barang.create', ['kategoris' => $kategoris]);
    }
    public function show(string $id)
    {
        $barang = BarangModel::find($id);

        return view('barang.show', ['barang' => $barang]);
    }
    public function index()
    {
            $breadcrumb = (object)[
                'title' => 'Daftar Barang',
                'list' => ['Home', 'Barang']
            ];
            $page = (object)[
                'title' => 'Daftar user yang terdaftar dalam sistem'
            ];
            $activeMenu = 'barang';
            $kategoris = KategoriModel::all();
            return view('barang.index', [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'kategori' => $kategoris,
                'activeMenu' => $activeMenu
            ]);
        }
    // Ambil data kategori dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
            ->with('kategori');

        if ($request->kateogri_id) {
            $barangs->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($barangs)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) {
                $btn = '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/show') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/edit') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/delete') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan halaman form edit kategori
    public function edit(string $id)
        {
            $barang = BarangModel::find($id);
            $kategoris = KategoriModel::select('kategori_id', 'kategori_nama')->get();
    
            return view('barang.edit', ['barang' => $barang, 'kategoris' => $kategoris]);
        }
    
    // Menyimpan perubahan data kategori
    public function update(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_kode' => 'required|string|min:3|max:10',
                'barang_nama' => 'required|string|min:3|max:100',
                'harga_beli' => 'required|numeric',
                'harga_jual' => 'required|numeric',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = BarangModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }
    // Menghapus data kategori
    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);
        if (!$check) {
            // untuk mengecek apakah data kategori dengan id yang dimaksud ada atau tidak
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }

        try {
            KategoriModel::destroy($id); // Hapus data level
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    // jobsheet 6
    // public function create_ajax()
    // {
    //     $level = BarangModel::select('level_id', 'level_nama')->get();
    //     return view('kategori.create_ajax')
    //         ->with('level', $level);
    // }
    public function store(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'level_id' => 'required|integer',
                'kategoriname' => 'required|string|min:3|unique:m_kategori,kategoriname',
                'nama'     => 'required|string|max:100',
                'password' => 'required|min:6'
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // pesan error validasi
                ]);
            }

            KategoriModel::create($request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Data kategori berhasil disimpan'
            ]);
        }

        redirect('/');
    }
    // jobsheet 6
    //menampilkan halaman form edit kategori ajax
    public function confirm(string $id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.confirm_ajax', ['kategori' => $kategori]);
    }
}
