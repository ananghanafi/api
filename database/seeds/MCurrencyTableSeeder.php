<?php

use Illuminate\Database\Seeder;

class MCurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('m_currency')->insert([
            'id' => 1,
            'code' => 'IDR',
            'name' => 'Indonesia Rupiah',
            'symbol' => 'Rp',
            'is_active' => true,
        ]);
        DB::table('m_currency')->insert([
            'id' => 2,
            'code' => 'USD',
            'name' => 'US Dollar',
            'symbol' => '$',
            'is_active' => true,
        ]);
    }
}
