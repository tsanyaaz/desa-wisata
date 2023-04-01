<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Tsany',
            'email' => 'tsanyaaz@gmail.com',
            'password' => bcrypt('123qweasd'),
            'level' => 'Administrator',
            'address' => 'Jl. Jalan',
            'phone' => '081234567890',
            'aktif' => 1,
            'created_at' => '2021-01-01 00:00:00',
            'updated_at' => '2021-01-01 00:00:00',
        ]);
    }
}
