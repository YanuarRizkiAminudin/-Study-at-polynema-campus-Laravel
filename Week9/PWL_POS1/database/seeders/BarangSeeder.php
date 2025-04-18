<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [     
            ['kategori_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Roti','harga_beli'=>4000 ,'harga_jual'=> 5000],
            ['kategori_id' => 1, 'barang_kode' => 'BRG002', 'barang_nama' => 'Sosis','harga_beli'=>7000,'harga_jual'=> 8000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG003', 'barang_nama' => 'Teh Botol','harga_beli'=> 2500, 'harga_jual' => 3000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG004', 'barang_nama' => 'mie','harga_beli'=>2000, 'harga_jual' => 2900],
            ['kategori_id' => 3, 'barang_kode' => 'BRG005', 'barang_nama' => 'tengo','harga_beli'=>4000, 'harga_jual' =>5000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG006', 'barang_nama' => 'oreo','harga_beli'=>5000, 'harga_jual' => 7000],
            ['kategori_id' => 4, 'barang_kode' => 'BRG007', 'barang_nama' => 'kopi','harga_beli'=>300, 'harga_jual' => 500],
            ['kategori_id' => 4, 'barang_kode' => 'BRG008', 'barang_nama' => 'susu','harga_beli'=>7000, 'harga_jual' => 10000],
            ['kategori_id' => 5, 'barang_kode' => 'BRG009', 'barang_nama' => 'larutan','harga_beli'=>6000, 'harga_jual' => 7000],
            ['kategori_id' => 5, 'barang_kode' => 'BRG010', 'barang_nama' => 'tolak angin','harga_beli'=>3500, 'harga_jual' => 4000],        
        ];

        DB::table('m_barang')->insert($data);
    }
}
