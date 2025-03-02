<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'pembeli' => 'Yanuar Rizki',
                'penjualan_kode' => 'TRX001',
                'tanggal_penjualan' => date('Y-m-d H:i:s', strtotime('2025-02-26')),
            ],
            [
                'user_id' => 2,
                'pembeli' => 'Muhamad Syaifulah ',
                'penjualan_kode' => 'TRX002',
                'tanggal_penjualan' => date('Y-m-d H:i:s', strtotime('2025-02-26')),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'beril fucky',
                'penjualan_kode' => 'TRX003',
                'tanggal_penjualan' => date('Y-m-d H:i:s', strtotime('2025-02-27')),
            ],
            [
                'user_id' => 1,
                'pembeli' => 'Maulana Rengga',
                'penjualan_kode' => 'TRX004',
                'tanggal_penjualan' => date('Y-m-d H:i:s', strtotime('2025-02-27')),
            ],
            [
                'user_id' => 2,
                'pembeli' => 'Muhamad Ekya ',
                'penjualan_kode' => 'TRX005',
                'tanggal_penjualan' => date('Y-m-d H:i:s', strtotime('2025-02-28')),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Gilang andi',
                'penjualan_kode' => 'TRX006',
                'tanggal_penjualan' => date('Y-m-d H:i:s', strtotime('2025-02-28')),
            ],
            [
                'user_id' => 1,
                'pembeli' => ' lelita',
                'penjualan_kode' => 'TRX007',
                'tanggal_penjualan' => date('Y-m-d H:i:s', strtotime('2025-02-29')),
            ],
            [
                'user_id' => 2,
                'pembeli' => 'inama',
                'penjualan_kode' => 'TRX008',
                'tanggal_penjualan' => date('Y-m-d H:i:s', strtotime('2025-02-29')),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'erik ridho firmansah',
                'penjualan_kode' => 'TRX009',
                'tanggal_penjualan' => date('Y-m-d H:i:s', strtotime('2025-03-01')),
            ],
            [
                'user_id' => 1,
                'pembeli' => 'Tegar',
                'penjualan_kode' => 'TRX010',
                'tanggal_penjualan' => date('Y-m-d H:i:s', strtotime('2025-03-02')),
            ]
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
