<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['barang_id' => 1, 'stok_jumlah' => 50, 'user_id' => 1, 'stok_tanggal' => Carbon::now()],
            ['barang_id' => 2, 'stok_jumlah' => 30, 'user_id' => 1, 'stok_tanggal' => Carbon::now()],
            ['barang_id' => 3, 'stok_jumlah' => 20, 'user_id' => 1, 'stok_tanggal' => Carbon::now()],
            ['barang_id' => 4, 'stok_jumlah' => 30, 'user_id' => 1, 'stok_tanggal' => Carbon::now()],
            ['barang_id' => 5, 'stok_jumlah' => 50, 'user_id' => 1, 'stok_tanggal' => Carbon::now()],
            ['barang_id' => 6, 'stok_jumlah' => 60, 'user_id' => 1, 'stok_tanggal' => Carbon::now()],
            ['barang_id' => 7, 'stok_jumlah' => 10, 'user_id' => 1, 'stok_tanggal' => Carbon::now()],
            ['barang_id' => 8, 'stok_jumlah' => 80, 'user_id' => 1, 'stok_tanggal' => Carbon::now()],
            ['barang_id' => 9, 'stok_jumlah' => 20, 'user_id' => 1, 'stok_tanggal' => Carbon::now()],
            ['barang_id' => 10, 'stok_jumlah' => 20, 'user_id' => 1, 'stok_tanggal' => Carbon::now()],
        ];

        DB::table('t_stok')->insert($data);
    }
}
