<?php

use Illuminate\Database\Seeder;

class FundingSourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('funding_sources')->insert([
            'type' => 'apbn',
            'year' => '2018',
            'remark' => 'APBN 2018',
        ]);
        DB::table('funding_sources')->insert([
            'type' => 'apbd',
            'year' => '2018',
            'remark' => 'APBD 2018',
        ]);
        DB::table('funding_sources')->insert([
            'type' => 'donor',
            'year' => '2018',
            'remark' => 'DONOR 2018',
        ]);
    }
}
