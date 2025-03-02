<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'tgl_penjualan' => now()->subDays(10 - $i), // misalnya 10 hari kebelakang
                'total_bayar'   => rand(50000, 200000),    // total bayar acak
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        DB::table('t_penjualan')->insert($data);
    }
}
