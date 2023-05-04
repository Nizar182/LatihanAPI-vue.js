<?php

namespace Database\Seeders;

use App\Models\SpotVaccine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpotVaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 100; $i++) {
            # code...
            SpotVaccine::create([
                'spot_id' => $i,
                'vaccine_id' => $i,
            ]);
        }
    }
}
