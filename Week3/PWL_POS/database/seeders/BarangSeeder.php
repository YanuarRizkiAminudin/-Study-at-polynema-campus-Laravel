<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run()
    {
        DB::table('m_barang')->insert([
            [
                'kategori_id'  => 1, // misalnya Elektronik
                'nama_barang'  => 'Smartphone',
                'harga'        => 2000000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kategori_id'  => 1,
                'nama_barang'  => 'Laptop',
                'harga'        => 5000000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kategori_id'  => 1,
                'nama_barang'  => 'Headset',
                'harga'        => 150000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kategori_id'  => 2, // Fashion
                'nama_barang'  => 'Kaos',
                'harga'        => 50000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kategori_id'  => 2,
                'nama_barang'  => 'Celana',
                'harga'        => 100000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kategori_id'  => 2,
                'nama_barang'  => 'Jaket',
                'harga'        => 200000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kategori_id'  => 3, // Makanan
                'nama_barang'  => 'Roti',
                'harga'        => 10000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kategori_id'  => 4, // Minuman
                'nama_barang'  => 'Air Mineral',
                'harga'        => 3000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kategori_id'  => 5, // ATK
                'nama_barang'  => 'Buku Tulis',
                'harga'        => 5000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kategori_id'  => 5,
                'nama_barang'  => 'Pensil',
                'harga'        => 2000,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
