<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        // Kita asumsikan penjualan_id dari 1 sampai 10
        // Masing-masing penjualan_id punya 3 barang
        for ($penjualanId = 1; $penjualanId <= 10; $penjualanId++) {
            for ($i = 1; $i <= 3; $i++) {
                // barang_id acak antara 1 s/d 10
                $barangId = rand(1, 10);
                $qty = rand(1, 5);
                $subtotal = rand(10000, 50000);

                $data[] = [
                    'penjualan_id' => $penjualanId,
                    'barang_id'    => $barangId,
                    'qty'          => $qty,
                    'subtotal'     => $subtotal,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            }
        }

        DB::table('t_penjualan_detail')->insert($data);
    }
}
