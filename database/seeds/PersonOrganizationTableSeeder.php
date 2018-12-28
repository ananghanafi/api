<?php

use Illuminate\Database\Seeder;

class PersonOrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('person_organization')->insert(['id' => 1, 'person_id' => 1, 'organization_id' => 1, 'is_admin' => false, ]);
        DB::table('person_organization')->insert(['id' => 2, 'person_id' => 2, 'organization_id' => 1, 'is_admin' => false, ]);
        DB::table('person_organization')->insert(['id' => 3, 'person_id' => 3, 'organization_id' => 1, 'is_admin' => false, ]);
        DB::table('person_organization')->insert(['id' => 4, 'person_id' => 4, 'organization_id' => 1, 'is_admin' => false, ]);
        DB::table('person_organization')->insert(['id' => 5, 'person_id' => 5, 'organization_id' => 1, 'is_admin' => false, ]);
        DB::table('person_organization')->insert(['id' => 6, 'person_id' => 6, 'organization_id' => 1, 'is_admin' => false, ]);
    }
}
