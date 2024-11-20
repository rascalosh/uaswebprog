<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'Admin',
            "is_admin" => 1,
            'full_name' => "Akun Kos Aloha",
            "email" => "noreply.alohakost@gmail.com",
            "gender" => "P",
            "password" => Hash::make("12345678"),
            "no_telp" => "00000000000"
        ];

        DB::table('users')->insert($admin);
    }
}
