<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'id' => 1,
            'admin_id' => 'Pembasahan Gambut',
            'admin_en' => 'Peatland Rewetting',
        ]);
        DB::table('admin')->insert([
            'id' => 2,
            'admin_id' => 'Rehabilitasi Vegetasi (Revegetasi)',
            'admin_en' => 'Vegetation Rehabilitation (Revegetation)',
        ]);
    }
}
