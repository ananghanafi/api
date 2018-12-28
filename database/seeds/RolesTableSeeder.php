<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'superadmin',
            'display_name' => 'Admin',
            'description' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'deputi-1',
            'display_name' => 'Deputi 1',
            'description' => 'Deputi 1',
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'deputi-2',
            'display_name' => 'Deputi 2',
            'description' => 'Deputi 2',
        ]);
        DB::table('roles')->insert([
            'id' => 4,
            'name' => 'deputi-3',
            'display_name' => 'Deputi 3',
            'description' => 'Deputi 3',
        ]);
        DB::table('roles')->insert([
            'id' => 5,
            'name' => 'deputi-4',
            'display_name' => 'Deputi 4',
            'description' => 'Deputi 4',
        ]);
        DB::table('roles')->insert([
            'id' => 6,
            'name' => 'admin-prov',
            'display_name' => 'Admin Provinsi',
            'description' => 'Admin Provinsi',
        ]);
        DB::table('roles')->insert([
            'id' => 7,
            'name' => 'admin-kota',
            'display_name' => 'Admin Kota',
            'description' => 'Admin Kota',
        ]);
        DB::table('roles')->insert([
            'id' => 8,
            'name' => 'opr-prov',
            'display_name' => 'Operator Provinsi',
            'description' => 'Operator Provinsi',
        ]);
        DB::table('roles')->insert([
            'id' => 9,
            'name' => 'opr-kota',
            'display_name' => 'Operator Kota',
            'description' => 'Operator Kota',
        ]);
    }
}
