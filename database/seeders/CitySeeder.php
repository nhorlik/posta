<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $file = storage_path('app/cities.csv');
        if (!file_exists($file)) return;

        $handle = fopen($file, 'r');
        fgetcsv($handle); 

        $cities = [];
        $now = now();

        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $cities[] = [
                'id' => $data[0],
                'name' => $data[1],
                'zip_code' => $data[2],
                'county_id' => $data[3],
                'population' => rand(1000, 50000),
                'created_at' => $now,
                'updated_at' => $now,
            ];

            
            if (count($cities) >= 500) {
                DB::table('cities')->insert($cities);
                $cities = [];
            }
        }

        
        if (!empty($cities)) {
            DB::table('cities')->insert($cities);
        }

        fclose($handle);
    }
}