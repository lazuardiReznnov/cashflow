<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        tag::create([
            'name' => 'debt',
        ]);
        tag::create([
            'name' => 'prive',
        ]);
        tag::create([
            'name' => 'income',
        ]);
    }
}
