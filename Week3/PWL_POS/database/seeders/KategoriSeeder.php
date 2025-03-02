<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        DB::table('m_kategori')->insert([
            ['kategori_nama' => 'Elektronik',   'created_at' => now(), 'updated_at' => now()],
            ['kategori_nama' => 'Fashion',      'created_at' => now(), 'updated_at' => now()],
            ['kategori_nama' => 'Makanan',      'created_at' => now(), 'updated_at' => now()],
            ['kategori_nama' => 'Minuman',      'created_at' => now(), 'updated_at' => now()],
            ['kategori_nama' => 'ATK',          'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
