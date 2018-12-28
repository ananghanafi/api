<?php

use Illuminate\Database\Seeder;

class MBurnStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // id, desc
        DB::table('m_burn_status')->insert([
            'id' => '1',
            'desc' => 'Areal Terbakar 2015',
        ]);
        DB::table('m_burn_status')->insert([
            'id' => '2',
            'desc' => 'Areal Terbakar 2015-2016',
        ]);
        DB::table('m_burn_status')->insert([
            'id' => '3',
            'desc' => 'Areal Terbakar 2016',
        ]);
    }
}
