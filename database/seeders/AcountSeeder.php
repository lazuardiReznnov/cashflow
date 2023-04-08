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
            ],
            [
                'name' => '20001',
                'slug' => '20001',
                'description' => 'Penerimaan masuk',
            ],
            [
                'name' => '20002',
                'slug' => '20002',
                'description' => 'Penerimaan masuk DP',
            ],

            [
                'name' => '30001',
                'slug' => '30001',
                'description' => 'Pembayaran Keluar',
            ],
            [
                'name' => '30002',
                'slug' => '30002',
                'description' => 'Pembayaran Keluar DP',
            ],
            [
                'name' => '30003',
                'slug' => '30003',
                'description' => 'Pembayaran Keluar Fee',
            ],
            [
                'name' => '40001',
                'slug' => '40001',
                'description' => 'Penerimaan masuk investasi',
            ],
            [
                'name' => '40002',
                'slug' => '40002',
                'description' => 'Pembayaran masuk investasi',
            ],
            [
                'name' => '40003',
                'slug' => '40003',
                'description' => 'Pembayaran masuk Prive',
            ],
        ];
        acount::insert($data);
    }
}
