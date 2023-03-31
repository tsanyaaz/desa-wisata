<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TouristAttractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tourist_attractions')->insert([
            'ta_name' => 'Bukit Bintang',
            'ta_desc' => 'Bukit Bintang is a hill in Kuala Lumpur, Malaysia. It is located in the Golden Triangle, a commercial and entertainment hub in the city. The hill is 276 metres (906 ft) above sea level and is the highest point in the city. The hill is named after the Bintang (Star) newspaper, which was founded in 1945 and was located in the area. The hill is also known as Bukit Nanas, after the Nanas River, which flows through the area. The hill is also known as Bukit Nanas, after the Nanas River, which flows through the area.',
            'ta_facilities' => 'Parking, Food, Restroom',
        ]);
    }
}
