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
            'aktif' => 1,
        ]);
    }
}
