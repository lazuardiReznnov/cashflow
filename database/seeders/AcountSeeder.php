<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\acount;

class AcountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => '10001',
                'slug' => '10001',
                'description' => 'Terima Saldo',
                'state' => 0,
            ],
            [
                'name' => '20001',
                'slug' => '20001',
                'description' => 'Penerimaan masuk',
                'state' => 0,
            ],
            [
                'name' => '20002',
                'slug' => '20002',
                'description' => 'Penerimaan masuk DP',
                'state' => 0,
            ],

            [
                'name' => '20003',
                'slug' => '20003',
                'description' => 'Penerimaan masuk investasi',
                'state' => 0,
            ],

            [
                'name' => '30001',
                'slug' => '30001',
                'description' => 'Pembayaran Keluar',
                'state' => 1,
            ],
            [
                'name' => '30002',
                'slug' => '30002',
                'description' => 'Pembayaran Keluar DP',
                'state' => 1,
            ],
            [
                'name' => '30003',
                'slug' => '30003',
                'description' => 'Pembayaran Keluar Fee',
                'state' => 1,
            ],
            [
                'name' => '30004',
                'slug' => '30004',
                'description' => 'Pembayaran Investasi',
                'state' => 1,
            ],

            [
                'name' => '30005',
                'slug' => '30005',
                'description' => 'Pembayaran Prive',
                'state' => 1,
            ],
        ];
        acount::insert($data);
    }
}
