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
            'jenis_id' => 'Lembaga',
            'jenis_en' => 'Institution',
        ]);
        DB::table('jenis')->insert([
            'id' => 2,
            'jenis_id' => 'Instansi',
            'jenis_en' => 'Agency',
        ]);
        DB::table('jenis')->insert([
            'id' => 3,
            'jenis_id' => 'Universitas',
            'jenis_en' => 'University',
        ]);
        DB::table('jenis')->insert([
            'id' => 4,
            'jenis_id' => 'Organisasi',
            'jenis_en' => 'Organization',
        ]);
        DB::table('jenis')->insert([
            'id' => 5,
            'jenis_id' => 'Institusi',
            'jenis_en' => 'Institution',
        ]);
    }
}
