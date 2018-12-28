<?php

use Illuminate\Database\Seeder;

class MCanalBlockingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('m_canal_blocking_types')->insert([ 'id' => 1, 'desc' => 'Sekat Primer', ]);
        DB::table('m_canal_blocking_types')->insert([ 'id' => 2, 'desc' => 'Sekat Sekunder & Tersier', ]);
    }
}
