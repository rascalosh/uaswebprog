<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KamarPerempuanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $info_kamar = [
            [
                'nomor_kamar' => '1A',
                'tipe_kamar' => 1
            ],
            [
                'nomor_kamar' => '1B',
                'tipe_kamar' => 1
            ],
            [
                'nomor_kamar' => '2A',
                'tipe_kamar' => 0
            ],
            [
                'nomor_kamar' => '2B',
                'tipe_kamar' => 0
            ],
            [
                'nomor_kamar' => '2C',
                'tipe_kamar' => 0
            ],
            [
                'nomor_kamar' => '2D',
                'tipe_kamar' => 0
            ],
            [
                'nomor_kamar' => '3A',
                'tipe_kamar' => 0
            ],
            [
                'nomor_kamar' => '3B',
                'tipe_kamar' => 0
            ],
            [
                'nomor_kamar' => '3C',
                'tipe_kamar' => 0
            ],
            [
                'nomor_kamar' => '3D',
                'tipe_kamar' => 0
            ],
        ];
        DB::table('kamar_perempuan')->insert($info_kamar);
    }
}
