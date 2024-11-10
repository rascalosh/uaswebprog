<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KamarPriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $info_kamar = [
            [
                'nomor_kamar' => '1A',
                'tipe_kamar' => 'dalam'
            ],
            [
                'nomor_kamar' => '1B',
                'tipe_kamar' => 'dalam'
            ],
            [
                'nomor_kamar' => '2A',
                'tipe_kamar' => 'luar'
            ],
            [
                'nomor_kamar' => '2B',
                'tipe_kamar' => 'luar'
            ],
            [
                'nomor_kamar' => '2C',
                'tipe_kamar' => 'luar'
            ],
            [
                'nomor_kamar' => '2D',
                'tipe_kamar' => 'luar'
            ],
            [
                'nomor_kamar' => '3A',
                'tipe_kamar' => 'luar'
            ],
            [
                'nomor_kamar' => '3B',
                'tipe_kamar' => 'luar'
            ],
            [
                'nomor_kamar' => '3C',
                'tipe_kamar' => 'luar'
            ],
            [
                'nomor_kamar' => '3D',
                'tipe_kamar' => 'luar'
            ],
        ];
        DB::table('kamar_pria')->insert($info_kamar);
    }
}
