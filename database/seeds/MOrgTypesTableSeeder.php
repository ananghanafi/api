<?php

use Illuminate\Database\Seeder;

class MOrgTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('m_org_types')->insert([
            'id' => 1,
            'org_type' => 'Pemerintah Pusat',
            'is_gov' => true,
        ]);
        DB::table('m_org_types')->insert([
            'id' => 2,
            'org_type' => 'Pemerintah Provinsi',
            'is_gov' => true,
        ]);
        DB::table('m_org_types')->insert([
            'id' => 3,
            'org_type' => 'Pemerintah Kota/Kab',
            'is_gov' => true,
        ]);
        DB::table('m_org_types')->insert([
            'id' => 4,
            'org_type' => 'Perusahaan',
        ]);
        DB::table('m_org_types')->insert([
            'id' => 5,
            'org_type' => 'Institusi Pendidikan',
        ]);
        DB::table('m_org_types')->insert([
            'id' => 6,
            'org_type' => 'Komunitas',
        ]);
        DB::table('m_org_types')->insert([
            'id' => 7,
            'org_type' => 'LSM / NGO',
        ]);
        DB::table('m_org_types')->insert([
            'id' => 99,
            'org_type' => 'Lainnya',
        ]);
    }
}
