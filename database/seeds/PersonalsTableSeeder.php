<?php

use Illuminate\Database\Seeder;

class PersonalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personals')->insert([
            'id' => 1,
            'name'=> 'Saya',
            'email'=> 'Saya@gg.com',
            'jenis'=> 'Lembaga',
            'tanggal'=>'121212',
            'jmlanggota'=> '12',
            'admin'=>'kabupaten',
            'password'=> 'saya',
            'api_token'=>'asas',
        ]);
        DB::table('personals')->insert([
            'id' => 2,
            'name'=> 'Saya',
            'email'=> 'Saya@gg.com',
            'jenis'=> 'Lembaga',
            'tanggal'=>'121212',
            'jmlanggota'=> '12',
            'admin'=>'kabupaten',
            'password'=> 'saya',
            'api_token'=>'asas',
        ]);
        DB::table('personals')->insert([
            'id' => 3,
            'name'=> 'Saya',
            'email'=> 'Saya@gg.com',
            'jenis'=> 'Lembaga',
            'tanggal'=>'121212',
            'jmlanggota'=> '12',
            'admin'=>'kabupaten',
            'password'=> 'saya',
            'api_token'=>'asas',
        ]);
        DB::table('personals')->insert([
            'id' => 4,
            'name'=> 'Saya',
            'email'=> 'Saya@gg.com',
            'jenis'=> 'Lembaga',
            'tanggal'=>'121212',
            'jmlanggota'=> '12',
            'admin'=>'kabupaten',
            'password'=> 'saya',
            'api_token'=>'asas',
        ]);
        DB::table('personals')->insert([
            'id' => 5,
            'name'=> 'Saya',
            'email'=> 'Saya@gg.com',
            'jenis'=> 'Lembaga',
            'tanggal'=>'121212',
            'jmlanggota'=> '12',
            'admin'=>'kabupaten',
            'password'=> 'saya',
            'api_token'=>'asas',
        ]);
    }
}
