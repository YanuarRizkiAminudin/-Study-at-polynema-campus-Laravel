<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'barang_kode' => 'B001',
                'barang_nama' => 'Smartphone',
                'harga_beli' => 2000000,
                'harga_jual' => 2400000,
            ],
            [
                'kategori_id' => 1,
                'barang_kode' => 'B002',
                'barang_nama' => 'Laptop',
                'harga_beli' => 500000,
                'harga_jual' => 650000,
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'B003',
                'barang_nama' => 'Headset',
                'harga_beli' => 150000,
                'harga_jual' => 200000,
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'B004',
                'barang_nama' => 'Kaos',
                'harga_beli' => 50000,
                'harga_jual' => 75000,
            ],

            // Kategori 3: Makanan & Minuman
            [
                'kategori_id' => 3,
                'barang_kode' => 'B005',
                'barang_nama' => 'Celana',
                'harga_beli' => 100000,
                'harga_jual' => 120000,
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'B006',
                'barang_nama' => 'Jaket',
                'harga_beli' => 200000,
                'harga_jual' => 5000,
            ],

            // Kategori 4: Perawatan Rumah
            [
                'kategori_id' => 4,
                'barang_kode' => 'B007',
                'barang_nama' => 'roti',
                'harga_beli' => 10000,
                'harga_jual' => 12000,
            ],
            [
                'kategori_id' => 4,
                'barang_kode' => 'B008',
                'barang_nama' => 'air minum',
                'harga_beli' => 2500,
                'harga_jual' => 3000,
            ],
            [
                'kategori_id' => 5,
                'barang_kode' => 'B009',
                'barang_nama' => 'Buku Tulis',
                'harga_beli' => 4500,
                'harga_jual' => 5000,
            ],
            [
                'kategori_id' => 5,
                'barang_kode' => 'B010',
                'barang_nama' => 'Pensil',
                'harga_beli' => 1500,
                'harga_jual' => 2000,
            ]
        ];
        DB::table('m_barang')->insert($data);
    }
}
