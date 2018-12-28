<?php

use Illuminate\Database\Seeder;

class MVegetationDensityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // id, density, land_cover
        DB::table('m_vegetation_density')->insert([
            'id' => '1',
            'density' => 'Rendah',
            'land_cover' => 'Terbuka (<25%)',
        ]);
        DB::table('m_vegetation_density')->insert([
            'id' => '2',
            'density' => 'Sedang',
            'land_cover' => 'Tertutup Jarang (25%-50%)',
        ]);
        DB::table('m_vegetation_density')->insert([
            'id' => '3',
            'density' => 'Tinggi',
            'land_cover' => 'Tertutup Rapat (>50%)',
        ]);

    }
}
