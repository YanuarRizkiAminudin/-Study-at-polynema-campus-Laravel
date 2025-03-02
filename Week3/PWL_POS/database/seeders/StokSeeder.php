<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run()
    {
        // Misalnya kita isi stok untuk barang_id dari 1 sampai 10
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'barang_id'  => $i,
                'jumlah'     => rand(10, 50), // stok acak antara 10-50
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('t_stok')->insert($data);
    }
}
