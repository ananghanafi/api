<?php

use Illuminate\Database\Seeder;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('person')->insert([
            'id' => '1',
            'full_name' => 'Nazir Foead',
            'title_prefix' => 'Ir.',
            'title_suffix' => 'M.Sc.',
            'gender' => 'L',
            'is_deleted' => false,
            'user_id' => 2,
        ]);
        DB::table('person')->insert([
            'id' => '2',
            'full_name' => 'Hartono',
            'title_prefix' => 'Ir.',
            'title_suffix' => 'M.Sc.',
            'gender' => 'L',
            'is_deleted' => false,
            'user_id' => 3,
        ]);
        DB::table('person')->insert([
            'id' => '3',
            'full_name' => 'Budi Satyawan Wardhana',
            'gender' => 'L',
            'is_deleted' => false,
        ]);
        DB::table('person')->insert([
            'id' => '4',
            'full_name' => 'Alue Dohong',
            'title_prefix' => 'Dr.',
            'gender' => 'L',
            'is_deleted' => false,
        ]);
        DB::table('person')->insert([
            'id' => '5',
            'full_name' => 'Myrna Asnawati Safitri',
            'title_prefix' => 'Dr.',
            'gender' => 'P',
            'is_deleted' => false,
        ]);
        DB::table('person')->insert([
            'id' => '6',
            'full_name' => 'Haris Gunawan',
            'title_prefix' => 'Dr.',
            'gender' => 'L',
            'is_deleted' => false,
        ]);
    }
}
