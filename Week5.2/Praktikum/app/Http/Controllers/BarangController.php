<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    // Menampilkan halaman awal barang
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];
    
        $page = (object) [
            'title' => 'Tambah barang baru'
        ];
    
        $kategori = KategoriModel::all(); // ambil data ategori untuk ditampilkan di form
        $activeMenu = 'barang'; // set menu yang sedang aktif
    
        return view('barang.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data barang baru
public function store(Request $request)
{
    $request->validate([
        // barangname harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_barang kolom barangname
        'barangname' => 'required|string|min:3|unique:m_barang,barangname',
        'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
        'password' => 'required|min:5', // password harus diisi dan minimal 5 karakter
        'kategori_id' => 'required|integer' // kategor_id harus diisi dan berupa angka
    ]);

    BarangModel::create([
        'barangname' => $request->barangname,
        'nama' => $request->nama,
        'password' => bcrypt($request->password), // password dienkripsi sebelum disimpan
        'kategori_id' => $request->kategori_id
    ]);

    return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
} 
// Menampilkan detail barang
public function show(string $id)
{
    $barang = BarangModel::with('kategori')->find($id);

    $breadcrumb = (object) [
        'title' => 'Detail Barang',
        'list' => ['Home', 'Barang', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail barang'
    ];

    $activeMenu = 'barang'; // set menu yang sedang aktif

    return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
}   
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang',]
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif
        $kategori =KategoriModel::all();
        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'kategori'=>$kategori, 'activeMenu' => $activeMenu]); 
    }
    
    // Ambil data barang dalam bentuk json untuk datatables
public function list(Request $request)
{
    $barangs = BarangModel::select('barang_id', 'barangname', 'nama', 'Kategori_id')
        ->with('kategori');

        if($request->Kategori_id){
            $barangs->where('kategori_id', $request->kategori_id);
        }

    return DataTables::of(source: $barangs)
        // menambahkan kolom index / no urut (default nama kolom: DT RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
            $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a>';
            $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
}// Menampilkan halaman form edit barang
public function edit(string $id)
{
    $barang = BarangModel::find($id);
    $kategori = KategoriModel::all();

    $breadcrumb = (object) [
        'title' => 'Edit Barang',
        'list' => ['Home', 'Barang', 'Edit']
    ];

    $page = (object) [
        'title' => 'Edit barang'
    ];

    $activeMenu = 'barang'; // set menu yang sedang aktif

    return view('barang.edit', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'barang' => $barang,
        'kategori' => $kategori,
        'activeMenu' => $activeMenu
    ]);
}

// Menyimpan perubahan data barang
public function update(Request $request, string $id)
{
    $request->validate([
        // barangname harus diisi, berupa string, minimal 3 karakter,
        // dan bernilai unik di tabel m_barang kolom barangname kecuali untuk barang dengan id yang sedang diedit
        'barangname' => 'required|string|min:3|unique:m_barang,barangname,' . $id . ',barang_id',
        'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
        'password' => 'nullable|min:5', // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
        'kategori_id' => 'required|integer' // Kategori_id harus diisi dan berupa angka
    ]);

    BarangModel::find($id)->update([
        'barangname' => $request->barangname,
        'nama' => $request->nama,
        'password' => $request->password ? bcrypt($request->password) : BarangModel::find($id)->password,
        'kategori_id' => $request->kategori_id
    ]);

    return redirect('/barang')->with('success', 'Data barang berhasil diubah');
}
// Menghapus data barang
public function destroy(string $id)
{
    $check = BarangModel::find($id);
    if (!$check) {
        // untuk mengecek apakah data barang dengan id yang dimaksud ada atau tidak
        return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
    }

    try {
        BarangModel::destroy($id); // Hapus data Kategori
        return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
        // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}
}