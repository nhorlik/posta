<?php

namespace Database\Seeders;

use App\Models\County;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountySeeder extends Seeder
{
    public function run(): void
    {
        $file = storage_path('app/counties.csv');
        if (!file_exists($file)) return;

        $badges = [
            1 => 'fejer.jpg',
            2 => 'jasz.jpg',
            3 => 'baranya_0.jpg',
            4 => 'heves.jpg',
            5 => 'borsod.jpg',
            6 => 'komarom.jpg',
            7 => 'pest.jpg',
            8 => 'nograd.jpg',
            9 => 'bacs.jpg',
            10 => 'veszprem.jpg',
            11 => 'szabolcs.jpg',
            12 => 'gyor.jpg',
            13 => 'somogy.jpg',
            14 => 'tolna.jpg',
            15 => 'hajdu.jpg',
            16 => 'zala.jpg',
            17 => 'bekes.jpg',
            18 => 'csongrad.jpg',
            19 => 'vas.jpg',
        ];

        $handle = fopen($file, 'r');
        fgetcsv($handle); 

        $counties = [];
        $now = now();

        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $id = $data[0];
            $counties[] = [
                'id' => $id,
                'name' => $data[1],
                'badge' => $badges[$id] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($counties)) {
            DB::table('counties')->insert($counties);
        }

        fclose($handle);
    }
}