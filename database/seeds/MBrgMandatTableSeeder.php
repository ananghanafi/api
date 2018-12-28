<?php

use Illuminate\Database\Seeder;

class MBrgMandatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('m_brg_mandat')->insert([
            'id' => 1,
            'desc_id' => 'Pembasahan Gambut',
            'desc_en' => 'Peatland Rewetting',
        ]);
        DB::table('m_brg_mandat')->insert([
            'id' => 2,
            'desc_id' => 'Rehabilitasi Vegetasi (Revegetasi)',
            'desc_en' => 'Vegetation Rehabilitation (Revegetation)',
        ]);
        DB::table('m_brg_mandat')->insert([
            'id' => 3,
            'desc_id' => 'Revitalisasi Sosioekonomi Komunitas',
            'desc_en' => 'Socioeconomic Revitalization of the Community',
        ]);
        DB::table('m_brg_mandat')->insert([
            'id' => 4,
            'desc_id' => 'Perencanaan Penstabilan',
            'desc_en' => 'Planning Base Stabilization',
        ]);
        DB::table('m_brg_mandat')->insert([
            'id' => 5,
            'desc_id' => 'Penguatan Kebijakan dan Institusi',
            'desc_en' => 'Policy and Institutional Strengthening',
        ]);
        DB::table('m_brg_mandat')->insert([
            'id' => 6,
            'desc_id' => 'Perbaikan Kerjasama Internasional',
            'desc_en' => 'International Cooperation Improvement',
        ]);
        DB::table('m_brg_mandat')->insert([
            'id' => 7,
            'desc_id' => 'Perbaikan Peran Aktif Para Pihak',
            'desc_en' => 'Improvement of Active Roles of the Parties',
        ]);
        DB::table('m_brg_mandat')->insert([
            'id' => 8,
            'desc_id' => 'Penguatan Restorasi Gambut',
            'desc_en' => 'Peatland Restoration Empowerment',
        ]);
        DB::table('m_brg_mandat')->insert([
            'id' => 9,
            'desc_id' => 'Administrasi Manajemen dan Institusi',
            'desc_en' => 'Administration of Management and Institutional',
        ]);
    }
}
