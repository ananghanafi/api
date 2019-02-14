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
            'admin_id' => 'Provinsi',
            'admin_en' => 'Province',
        ]);
        DB::table('admin')->insert([
            'id' => 2,
            'admin_id' => 'Kabupaten/Kota',
            'admin_en' => 'District/City',
        ]);
        DB::table('admin')->insert([
            'id' => 3,
            'admin_id' => 'Kecamatan',
            'admin_en' => 'Sub-District',
        ]);
        DB::table('admin')->insert([
            'id' => 4,
            'admin_id' => 'Kelurahan',
            'admin_en' => '-',
        ]);
    }
}
