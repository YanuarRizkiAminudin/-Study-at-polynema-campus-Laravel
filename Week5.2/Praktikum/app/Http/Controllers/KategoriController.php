<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    // Menampilkan halaman awal Kategori
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];
    
        $page = (object) [
            'title' => 'Tambah kategori baru'
        ];
    
        //$level = LevelModel::all(); // ambil data level untuk ditampilkan di form
        $activeMenu = 'kategori'; // set menu yang sedang aktif
    
        return view('kategori.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            //'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data kategori baru
public function store(Request $request)
{
    $request->validate([
        // kategoriname harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_kategori kolom kategoriname
        'kategorikode' => 'required|string|min:3|unique:m_kategori, kategori_kode',
        'kategorinama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
        //'password' => 'required|min:5', // password harus diisi dan minimal 5 karakter
        //'level_id' => 'required|integer' // level_id harus diisi dan berupa angka
    ]);

    KategoriModel::create([
        'kategori_kode' => $request->kategori_kode,
        'kategori_nama' => $request->kategori_nama
        //'password' => bcrypt($request->password), // password dienkripsi sebelum disimpan
        //'level_id' => $request->level_id
    ]);

    return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
} 
// Menampilkan detail kategori
public function show(string $id)
{
    $kategori = KategoriModel::find($id);

    $breadcrumb = (object) [
        'title' => 'Detail Kategori',
        'list' => ['Home', 'Kategori', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail kategori'
    ];

    $activeMenu = 'kategori'; // set menu yang sedang aktif

    return view('kategori.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
}   
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori',]
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif
        //$level =LevelModel::all();
        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]); 
    }
    
    // Ambil data kategori dalam bentuk json untuk datatables
public function list(Request $request)
{
    $kategoris = KategoriModel::select('kategori_id', 'kategori_nama', 'kategori_kode');
       // ->with('level');

        // if($request->level_id){
        //     $kategoris->where('level_id', $request->level_id);
        // }

    return DataTables::of($kategoris)
        // menambahkan kolom index / no urut (default nama kolom: DT RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($kategori) { // menambahkan kolom aksi
            $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a>';
            $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
}// Menampilkan halaman form edit kategori
public function edit(string $id)
{
    $kategori = KategoriModel::find($id);
    //$level = LevelModel::all();

    $breadcrumb = (object) [
        'title' => 'Edit Kategori',
        'list' => ['Home', 'Kategori', 'Edit']
    ];

    $page = (object) [
        'title' => 'Edit kategori'
    ];

    $activeMenu = 'kategori'; // set menu yang sedang aktif

    return view('kategori.edit', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'kategori' => $kategori,
        //'level' => $level,
        'activeMenu' => $activeMenu
    ]);
}

// Menyimpan perubahan data kategori
public function update(Request $request, string $id)
{
    $request->validate([
        // kategoriname harus diisi, berupa string, minimal 3 karakter,
        // dan bernilai unik di tabel m_kategori kolom kategoriname kecuali untuk kategori dengan id yang sedang diedit
        'kategoriname' => 'required|string|min:3|unique:m_kategori,kategoriname,' . $id . ',kategori_id',
        'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
        'password' => 'nullable|min:5', // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
        'kategori_id' => 'required|integer' // level_id harus diisi dan berupa angka
    ]);

    KategoriModel::find($id)->update([
        'kategoriname' => $request->kategoriname,
        'nama' => $request->nama,
        'password' => $request->password ? bcrypt($request->password) : KategoriModel::find($id)->password,
        'kategori_id' => $request->kategori_id
    ]);

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

}