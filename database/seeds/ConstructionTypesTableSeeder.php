<?php

use Illuminate\Database\Seeder;

class ConstructionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('type')->insert([
            'id' => '1',
            'type' => 'sbo',
            'desc' => 'Sumur Bor',
        ]);
        DB::table('type')->insert([
            'id' => '2',
            'type' => 'sk',
            'desc' => 'Sekat Kanal',
        ]);
        DB::table('type')->insert([
            'id' => '3',
            'type' => 'rk',
            'desc' => 'Ruas Kanal',
        ]);
        DB::table('type')->insert([
            'id' => '4',
            'type' => 'pk',
            'desc' => 'Penimbunan Kanal',
        ]);

    }
}
