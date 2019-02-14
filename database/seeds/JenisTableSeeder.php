<?php

use Illuminate\Database\Seeder;

class JenisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis')->insert([
            'id' => 1,
            'jenis_id' => 'Pembasahan Gambut',
            'jenis_en' => 'Peatland Rewetting',
        ]);
        DB::table('jenis')->insert([
            'id' => 2,
            'jenis_id' => 'Rehabilitasi Vegetasi (Revegetasi)',
            'jenis_en' => 'Vegetation Rehabilitation (Revegetation)',
        ]);
    }
}
