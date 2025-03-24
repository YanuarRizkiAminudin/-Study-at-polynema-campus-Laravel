<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    // Menampilkan halaman awal level
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];
    
        $page = (object) [
            'title' => 'Tambah level baru'
        ];
    
        //$level = LevelModel::all(); // ambil data level untuk ditampilkan di form
        $activeMenu = 'level'; // set menu yang sedang aktif
    
        return view('level.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
         //   'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data level baru
public function store(Request $request)
{
    $request->validate([
        // levelname harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_level kolom levelname
        'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
        'level_nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
        //'password' => 'required|min:5', // password harus diisi dan minimal 5 karakter
        //'level_id' => 'required|integer' // level_id harus diisi dan berupa angka
    ]);

    LevelModel::create([
        'level_kode' => $request->level_kode,
        'level_nama' => $request->level_nama,
        //'password' => bcrypt($request->password), // password dienkripsi sebelum disimpan
        //'level_id' => $request->level_id
    ]);

    return redirect('/level')->with('success', 'Data level berhasil disimpan');
} 
// Menampilkan detail level
public function show(string $id)
{
    $level = LevelModel::find($id);

    $breadcrumb = (object) [
        'title' => 'Detail Level',
        'list' => ['Home', 'Level', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail level'
    ];

    $activeMenu = 'level'; // set menu yang sedang aktif

    return view('level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
}   
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level',]
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif
        //$level =LevelModel::all();
        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]); 
    }
    
    // Ambil data level dalam bentuk json untuk datatables
public function list(Request $request)
{
    $levels = LevelModel::select('level_id', 'level_nama', 'level_kode');
     //   ->with('level');

       // if($request->level_id){
         //   $levels->where('level_id', $request->level_id);
        //}

    return DataTables::of($levels)
        // menambahkan kolom index / no urut (default nama kolom: DT RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
            $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a>';
            $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
}// Menampilkan halaman form edit level
public function edit(string $id)
{
    $level = LevelModel::find($id);
    //$level = LevelModel::all();

    $breadcrumb = (object) [
        'title' => 'Edit Level',
        'list' => ['Home', 'Level', 'Edit']
    ];

    $page = (object) [
        'title' => 'Edit level'
    ];

    $activeMenu = 'level'; // set menu yang sedang aktif

    return view('level.edit', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'level' => $level,
        'activeMenu' => $activeMenu
    ]);
}

// Menyimpan perubahan data level
public function update(Request $request, string $id)
{
    $request->validate([
        // levelname harus diisi, berupa string, minimal 3 karakter,
        // dan bernilai unik di tabel m_level kolom levelname kecuali untuk level dengan id yang sedang diedit
        'levelname' => 'required|string|min:3|unique:m_level,levelname,' . $id . ',level_id',
        'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
        'password' => 'nullable|min:5', // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
        'level_id' => 'required|integer' // level_id harus diisi dan berupa angka
    ]);

    // $level = levelModel::find($id);
    // $level->update([
    //     'levelname' => $request->levelname,
    //     'nama' => $request->nama,
    //     'password' => $request->password ? bcrypt($request->password) : $level->password,
    //     'level_id' => $request->level_id
    // ]);
    LevelModel::find($id)->update([
        'levelname' => $request->levelname,
        'nama' => $request->nama,
        'password' => $request->password ? bcrypt($request->password) : LevelModel::find($id)->password,
        'level_id' => $request->level_id
    ]);


    return redirect('/level')->with('success', 'Data level berhasil diubah');
}
// Menghapus data level
public function destroy(string $id)
{
    $check = LevelModel::find($id);
    if (!$check) {
        // untuk mengecek apakah data level dengan id yang dimaksud ada atau tidak
        return redirect('/level')->with('error', 'Data level tidak ditemukan');
    }

    try {
        LevelModel::destroy($id); // Hapus data level
        return redirect('/level')->with('success', 'Data level berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
        // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}

}