<?php

namespace Database\Seeders;

use App\Models\Society;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 100; $i++) {
            Society::create([
                'name' => 'Elinore Tremblay ' . $i,
                'born_date' => Date('Y-m-d'),
                'gender' => 'male',
                'address' => '961 Rae Row Okunevaport Wisconsin South Jadaview',
                'regional_id' => $i,
                'user_id' => $i,
            ]);
        }
    }
}
