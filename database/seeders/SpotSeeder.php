<?php

namespace Database\Seeders;

use App\Models\Spot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 100; $i++) {
            Spot::create([
                'regional_id' => $i,
                'name' => 'Planner hospital ' . $i,
                'address' => '3169 Sheldon Extension South Gate Cook Islands ' . $i,
                'serve' => 3,
                'capacity' => 12,
            ]);
        }
    }
}
