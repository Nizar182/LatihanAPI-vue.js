<?php

namespace Database\Seeders;

use App\Models\Vaccine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vaccine_name = [
            'sinovac',
            'AstraZeneca',
            'Sinoparm',
            'Moderna',
            'Bio Farma',
            'Pfizer',
            'Sputnik V',
            'Jannsen',
            'Convidecia'
        ];
        foreach ($vaccine_name as $item) {
            Vaccine::create([
                'name' => $item,
            ]);
        }
    }
}
