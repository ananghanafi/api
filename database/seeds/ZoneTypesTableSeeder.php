<?php

use Illuminate\Database\Seeder;

class ZoneTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('zone_type')->insert([
            'id' => '1',
            'type' => '1',
            'desc' => 'Kawasan Konservasi',
        ]);
        DB::table('zone_type')->insert([
            'id' => '2',
            'type' => '2',
            'desc' => 'Kawasan Hutan',
        ]);
        DB::table('zone_type')->insert([
            'id' => '3',
            'type' => '3',
            'desc' => 'NK di Luar Kawasan Hutan',
        ]);
        DB::table('zone_type')->insert([
            'id' => '4',
            'type' => '4',
            'desc' => 'HGU',
        ]);
        DB::table('zone_type')->insert([
            'id' => '5',
            'type' => '5',
            'desc' => 'IUPHHK-HT',
        ]);
        DB::table('zone_type')->insert([
            'id' => '6',
            'type' => '6',
            'desc' => 'IUPHHK-HA',
        ]);
        DB::table('zone_type')->insert([
            'id' => '9',
            'type' => '9',
            'desc' => 'IUP',
        ]);
        DB::table('zone_type')->insert([
            'id' => '10',
            'type' => '4',
            'desc' => 'IUPHHK-RE',
        ]);
        DB::table('zone_type')->insert([
            'id' => '13',
            'type' => '13',
            'desc' => 'Tumpang Tindih',
        ]);

    }
}
