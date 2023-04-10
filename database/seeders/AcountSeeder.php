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
                'name' => '30001',
                'slug' => '30001',
                'description' => 'Pembayaran Keluar',
                'state' => 1,
            ],
        ];
        acount::insert($data);
    }
}
