<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    // Menampilkan halaman awal level
    public function create()
    {
        return view('level.create');
        // $breadcrumb = (object) [
        //     'title' => 'Tambah Level',
        //     'list' => ['Home', 'Level', 'Tambah']
        // ];

        // $page = (object) [
        //     'title' => 'Tambah level baru'
        // ];

        // $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
        // $activeMenu = 'level'; // set menu yang sedang aktif

        // return view('level.create', [
        //     'breadcrumb' => $breadcrumb,
        //     'page' => $page,
        //     'level' => $level,
        //     'activeMenu' => $activeMenu
        // ]);
    }

    // Menyimpan data level baru
    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|min:3|unique:m_level,level_kode|max:10',
                'level_nama' => 'required|string|min:3|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            LevelModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil disimpan'
            ]);
        }
        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }
    // Menampilkan detail level
    public function show(string $id)
    {
        $level = LevelModel::with('level')->find($id);

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
        $level = LevelModel::all();
        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Ambil data level dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        // $levels = LevelModel::select('level_id', 'levelname', 'nama', 'level_id')
        //     ->with('level');

        //     if($request->level_id){
        //         $levels->where('level_id', $request->level_id);
        //     }

        // return DataTables::of(source: $levels)
        //     // menambahkan kolom index / no urut (default nama kolom: DT RowIndex)
        //     ->addIndexColumn()
        //     ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
        //         $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a>';
        //         $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>';
        //         $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">'
        //             . csrf_field() . method_field('DELETE') .
        //             '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
        //         return $btn;
        //     })
        //     ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        //     ->make(true);

        $levels = LevelModel::select('level_id', 'levelname', 'nama', 'level_id')
            ->with('level');

        // Filter data level berdasarkan level_id
        if ($request->level_id) {
            $levels->where('level_id', $request->level_id);
        }

        return DataTables::of($levels)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
                // Tambahkan kode aksi di sini
                /* 
        $btn = '<a href="'.url('/level/' . $level->level_id).'" class="btn btn-info btn-sm">Detail</a> ';
        $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
        $btn .= '<form class="d-inline-block" method="POST" action="'. url('/level/'.$level->level_id).'">' . 
        csrf_field() . 
        method_field('DELETE') . 
        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>
        </form>';
*/

                $btn = '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi adalah HTML
            ->make(true);
    }

    // Menampilkan halaman form edit level
    public function edit(string $id)
    {
        $level = LevelModel::find($id);
        // $level = LevelModel::all();

        // $breadcrumb = (object) [
        //     'title' => 'Edit Level',
        //     'list' => ['Home', 'Level', 'Edit']
        // ];

        // $page = (object) [
        //     'title' => 'Edit level'
        // ];

        // $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.edit', [
            // 'breadcrumb' => $breadcrumb,
            // 'page' => $page,
            'level' => $level,
            // 'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data level
    public function update(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
            // levelname harus diisi, berupa string, minimal 3 karakter,
            // dan bernilai unik di tabel m_level kolom levelname kecuali untuk level dengan id yang sedang diedit
            'level_kode' => 'required|string|min:3|max:10',
            'level_nama' => 'required|string|min:3|max:100' // nama harus diisi, berupa string, dan maksimal 100 karakter
            // 'password' => 'nullable|min:5', // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
            // 'level_id' => 'required|integer' // level_id harus diisi dan berupa angka
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'msgField' => $validator->errors()
            ]);
        }

        $check = LevelModel::find($id);
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
    return redirect('/');
}
    // Menghapus data level
    // public function destroy(string $id)
    // {
    //     $check = LevelModel::find($id);
    //     if (!$check) {
    //         // untuk mengecek apakah data Level dengan id yang dimaksud ada atau tidak
    //         return redirect('/level')->with('error', 'Data level tidak ditemukan');
    //     }

    //     try {
    //         LevelModel::destroy($id); // Hapus data level
    //         return redirect('/level')->with('success', 'Data level berhasil dihapus');
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
    //         return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    //     }
    // }
    // jobsheet 6
    public function create_ajax()
    {
        
        return view('level.create_ajax');
    }
 
    public function confirm_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.confirm_ajax', ['level' => $level]);
    }

    public function delete(Request $request, $id)
    {
        // Cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                try {
                    $level->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data tidak bisa dihapus'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }
}
