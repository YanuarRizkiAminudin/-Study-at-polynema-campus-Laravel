<?php

namespace App\Http\Controllers;

use App\Models\Item;  // Import model Item agar bisa digunakan di controller
use Illuminate\Http\Request;  // Import Request untuk menangani input dari form

class ItemController extends Controller
{
    /**
     * Menampilkan daftar semua item.
     */
    public function index()
    {
        $items = Item::all();  // Ambil semua data item dari database
        return view('items.index', compact('items'));  // Kirim data item ke view items.index
    }

    /**
     * Menampilkan form untuk membuat item baru.
     */
    public function create()
    {
        return view('items.create');  // Tampilkan halaman form untuk membuat item
    }

    /**
     * Menyimpan item baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input dari pengguna untuk memastikan data yang diinput lengkap
        $request->validate([
            'name' => 'required',  // Kolom name harus diisi
            'description' => 'required',  // Kolom description harus diisi
        ]);

        // Simpan data item yang valid ke database
        Item::create($request->only(['name', 'description']));  // Simpan hanya name dan description

        // Arahkan kembali ke halaman daftar item dengan pesan sukses
        return redirect()->route('items.index')->with('success', 'Item added successfully.');
    }

    /**
     * Menampilkan detail item yang dipilih.
     */
    public function show(Item $item)
    {
        // Kirim data item yang dipilih ke view 'items.show'
        return view('items.show', compact('item'));
    }

    /**
     * Menampilkan form untuk mengedit item yang ada.
     */
    public function edit(Item $item)
    {
        // Kirim data item yang dipilih ke view 'items.edit'
        return view('items.edit', compact('item'));
    }

    /**
     * Memperbarui item yang dipilih di database.
     */
    public function update(Request $request, Item $item)
    {
        // Validasi input dari pengguna untuk memastikan data yang diinput valid
        $request->validate([
            'name' => 'required',  // Nama harus diisi
            'description' => 'required',  // Deskripsi harus diisi
        ]);

        // Update data item yang valid
        $item->update($request->only(['name', 'description']));  // Menggunakan hanya atribut yang diizinkan

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Menghapus item yang dipilih dari database.
     */
    public function destroy(Item $item)
    {
        // Menghapus data item dari database
        $item->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
