<?php

use Illuminate\Database\Seeder;

class MRevegetationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // id, desc
        DB::table('m_revegetation_type')->insert([
            'id' => '1',
            'desc' => 'Suksesi Alami',
        ]);
        DB::table('m_revegetation_type')->insert([
            'id' => '2',
            'desc' => 'Pengkayaan',
        ]);
        DB::table('m_revegetation_type')->insert([
            'id' => '3',
            'desc' => 'Penanaman Pola Maksimal',
        ]);

    }
}
