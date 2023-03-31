<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            'name' => 'Tsany',
            'address' => 'Jl. Jalan',
            'phone' => '081234567890',
            'jobtitle' => 'Administrator',
            // 'id_user' => 1,
        ]);
    }
}
