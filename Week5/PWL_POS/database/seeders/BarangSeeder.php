<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'B001', 'barang_nama' => 'Kopi', 'harga_beli' => 5000, 'harga_jual' => 7000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'B002', 'barang_nama' => 'Teh', 'harga_beli' => 4000, 'harga_jual' => 6000],
            ['barang_id' => 3, 'kategori_id' => 2, 'barang_kode' => 'B003', 'barang_nama' => 'Sabun Mandi', 'harga_beli' => 8000, 'harga_jual' => 12000],
            ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'B004', 'barang_nama' => 'Shampoo', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['barang_id' => 5, 'kategori_id' => 3, 'barang_kode' => 'B005', 'barang_nama' => 'Detergen', 'harga_beli' => 12000, 'harga_jual' => 18000],
            ['barang_id' => 6, 'kategori_id' => 3, 'barang_kode' => 'B006', 'barang_nama' => 'Pembersih Lantai', 'harga_beli' => 9000, 'harga_jual' => 13000],
            ['barang_id' => 7, 'kategori_id' => 4, 'barang_kode' => 'B007', 'barang_nama' => 'Susu Formula', 'harga_beli' => 25000, 'harga_jual' => 35000],
            ['barang_id' => 8, 'kategori_id' => 4, 'barang_kode' => 'B008', 'barang_nama' => 'Popok Bayi', 'harga_beli' => 50000, 'harga_jual' => 70000],
            ['barang_id' => 9, 'kategori_id' => 5, 'barang_kode' => 'B009', 'barang_nama' => 'Smartphone', 'harga_beli' => 2000000, 'harga_jual' => 2500000],
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => 'B010', 'barang_nama' => 'Laptop', 'harga_beli' => 6000000, 'harga_jual' => 7500000],
        ];

        DB::table('m_barang')->insert($data);
    }
}
