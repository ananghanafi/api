<?php

use Illuminate\Database\Seeder;

class MCanalTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('m_canal_types')->insert(['id' => 1, 'desc' => 'Kanal Collecting']);
        DB::table('m_canal_types')->insert(['id' => 2, 'desc' => 'Kanal Collecting 2']);
        DB::table('m_canal_types')->insert(['id' => 3, 'desc' => 'Kanal Outlet']);
        DB::table('m_canal_types')->insert(['id' => 6, 'desc' => 'Kanal Collecting dan Kanal Collecting 2']);
    }
}
