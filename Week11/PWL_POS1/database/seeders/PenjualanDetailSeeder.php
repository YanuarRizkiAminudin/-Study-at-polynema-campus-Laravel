<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detail =[];
        $jumlahBarang = 10;
        $barang_id = 1;

        for($penjualan_id = 1; $penjualan_id <= 10; $penjualan_id++) {
            for ($i = 0; $i < 3; $i++){
                $detail[] =[
                    'penjualan_id' => $penjualan_id,
                    'barang_id' => $barang_id,
                    'jumlah' => rand(1,5),
                    'harga' => rand(3000, 20000),
                ];
                $barang_id++;
                if ($barang_id > $jumlahBarang){
                    $barang_id = 1; //reset ke baran_id awal
                }
            }
        }

        DB::table('t_penjualan_detail')->insert($detail);
    }
}
