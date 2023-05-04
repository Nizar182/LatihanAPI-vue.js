<?php

namespace Database\Seeders;

use App\Models\Medical;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 100; $i++) {
            Medical::create([
                'user_id' => $i,
                'spot_id' => $i,
                'name' => 'Name ' . $i
            ]);
        }
    }
}
