<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        //Langkah 3
        //$data = [
            //'kategori_kode' => 'SNK',
            //'kategori_nama' => 'Snack/Makanan Ringan',
            //'created_at' => now()
        //];

        //DB::table('m_kategori')->insert($data);
        //return 'Insert data baru berhasil';

        //Langkah 5
        //$row = DB::table('m_kategori')
        //->where('kategori_kode', 'SNK')
        //->update(['kategori_nama' => 'Camilan']);

        //return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

        //Langkah 7
        //$row = DB::table('m_kategori')
        //->where('kategori_kode', 'SNK')
        //->delete();

        //return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        //$data = DB::table('m_kategori')->get();
        //return view('kategori', ['data' => $data]);

        // Jobsheet 5 | Praktikum 2
        return $dataTable->render('kategori.index');
    
    }

    // Jobsheet 5 | Praktikum 3 langkah 2
    public function create() {
        return view('kategori.create');
    }

    // Jobsheet 5 | Praktikum 3 langkah 2
    public function store(Request $request) {
        KategoriModel::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);
        return redirect('/kategori');
    }

    public function edit($id)
    {
         $kategori = KategoriModel::findOrFail($id);
         return view('kategori.edit', compact('kategori'));
    }
 
    public function update(Request $request, $id) {
         $request->validate([
             'kategori_kode' => 'required|string|max:50',
             'kategori_nama' => 'required|string|max:100',
         ]);
 
         $kategori = KategoriModel::findOrFail($id);
         $kategori->update([
             'kategori_kode' => $request->kategori_kode,
             'kategori_nama' => $request->kategori_nama,
         ]);
 
         return redirect('/kategori')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id) {
    $kategori = KategoriModel::findOrFail($id);
    $kategori->delete();

    return redirect('/kategori')->with('success', 'Kategori berhasil dihapus!');
}
}
