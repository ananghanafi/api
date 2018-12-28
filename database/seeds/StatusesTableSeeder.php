<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('status')->insert([
            'id' => '1',
            'status' => 'diajukan',
            'alt_status' => 'Indikatif',
        ]);
        DB::table('status')->insert([
            'id' => '2',
            'status' => 'disetujui',
            'alt_status' => 'Definitif',
        ]);
        DB::table('status')->insert([
            'id' => '9',
            'status' => 'ditolak',
            'alt_status' => 'Ditolak',
        ]);
    }
}
