<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TipeKamarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipe = [
            [
                'tipe_kamar' => 1,
                'desc_kamar' => "Menyediakan ruangan toilet di dalam kamar.",
                'harga' => 2300000
            ],
            [
                'tipe_kamar' => 0,
                'desc_kamar' => "Tidak menyediakan ruangan toilet di dalam kamar.",
                'harga' => 1700000
            ]
        ];

        DB::table('tipe_kamars')->insert($tipe);
    }
}
