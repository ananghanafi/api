<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('groups')->insert(['id' => '1', 'name' => 'dashboardplan', 'display_name' => 'dashboardplan', 'created_at' => '2018-11-18 16:17:41', 'updated_at' => '2018-11-18 16:17:41', ]);
        DB::table('groups')->insert(['id' => '2', 'name' => 'revitalizationplan', 'display_name' => 'revitalizationplan', 'created_at' => '2018-11-18 16:17:41', 'updated_at' => '2018-11-18 16:17:41', ]);
        DB::table('groups')->insert(['id' => '3', 'name' => 'revitalizationimpl', 'display_name' => 'revitalizationimpl', 'created_at' => '2018-11-18 16:17:45', 'updated_at' => '2018-11-18 16:17:45', ]);
        DB::table('groups')->insert(['id' => '4', 'name' => 'retentionbasinplan', 'display_name' => 'retentionbasinplan', 'created_at' => '2018-11-18 16:17:48', 'updated_at' => '2018-11-18 16:17:48', ]);
        DB::table('groups')->insert(['id' => '5', 'name' => 'retentionbasinimpl', 'display_name' => 'retentionbasinimpl', 'created_at' => '2018-11-18 16:17:50', 'updated_at' => '2018-11-18 16:17:50', ]);
        DB::table('groups')->insert(['id' => '6', 'name' => 'revegetationplan', 'display_name' => 'revegetationplan', 'created_at' => '2018-11-18 16:17:53', 'updated_at' => '2018-11-18 16:17:53', ]);
        DB::table('groups')->insert(['id' => '7', 'name' => 'revegetationimpl', 'display_name' => 'revegetationimpl', 'created_at' => '2018-11-18 16:17:56', 'updated_at' => '2018-11-18 16:17:56', ]);
        DB::table('groups')->insert(['id' => '8', 'name' => 'canalhoardingplan', 'display_name' => 'canalhoardingplan', 'created_at' => '2018-11-18 16:17:59', 'updated_at' => '2018-11-18 16:17:59', ]);
        DB::table('groups')->insert(['id' => '9', 'name' => 'canalhoardingimpl', 'display_name' => 'canalhoardingimpl', 'created_at' => '2018-11-18 16:18:2', 'updated_at' => '2018-11-18 16:18:2', ]);
        DB::table('groups')->insert(['id' => '10', 'name' => 'canalblockplan', 'display_name' => 'canalblockplan', 'created_at' => '2018-11-18 16:18:4', 'updated_at' => '2018-11-18 16:18:4', ]);
        DB::table('groups')->insert(['id' => '11', 'name' => 'canalblockimpl', 'display_name' => 'canalblockimpl', 'created_at' => '2018-11-18 16:18:7', 'updated_at' => '2018-11-18 16:18:7', ]);
        DB::table('groups')->insert(['id' => '12', 'name' => 'constructionplan', 'display_name' => 'constructionplan', 'created_at' => '2018-11-18 16:18:9', 'updated_at' => '2018-11-18 16:18:9', ]);
        DB::table('groups')->insert(['id' => '13', 'name' => 'constructionimpl', 'display_name' => 'constructionimpl', 'created_at' => '2018-11-18 16:18:12', 'updated_at' => '2018-11-18 16:18:12', ]);
        DB::table('groups')->insert(['id' => '14', 'name' => 'upload', 'display_name' => 'upload', 'created_at' => '2018-11-18 16:18:15', 'updated_at' => '2018-11-18 16:18:15', ]);
        DB::table('groups')->insert(['id' => '15', 'name' => 'subdistrict', 'display_name' => 'subdistrict', 'created_at' => '2018-11-18 16:18:15', 'updated_at' => '2018-11-18 16:18:15', ]);
        DB::table('groups')->insert(['id' => '16', 'name' => 'city', 'display_name' => 'city', 'created_at' => '2018-11-18 16:18:17', 'updated_at' => '2018-11-18 16:18:17', ]);
        DB::table('groups')->insert(['id' => '17', 'name' => 'province', 'display_name' => 'province', 'created_at' => '2018-11-18 16:18:18', 'updated_at' => '2018-11-18 16:18:18', ]);
        DB::table('groups')->insert(['id' => '18', 'name' => 'fundingsource', 'display_name' => 'fundingsource', 'created_at' => '2018-11-18 16:18:20', 'updated_at' => '2018-11-18 16:18:20', ]);
        DB::table('groups')->insert(['id' => '19', 'name' => 'mburnstatus', 'display_name' => 'mburnstatus', 'created_at' => '2018-11-18 16:18:21', 'updated_at' => '2018-11-18 16:18:21', ]);
        DB::table('groups')->insert(['id' => '20', 'name' => 'mvegetationdensity', 'display_name' => 'mvegetationdensity', 'created_at' => '2018-11-18 16:18:21', 'updated_at' => '2018-11-18 16:18:21', ]);
        DB::table('groups')->insert(['id' => '21', 'name' => 'mrevegetationtype', 'display_name' => 'mrevegetationtype', 'created_at' => '2018-11-18 16:18:22', 'updated_at' => '2018-11-18 16:18:22', ]);
        DB::table('groups')->insert(['id' => '22', 'name' => 'canaltype', 'display_name' => 'canaltype', 'created_at' => '2018-11-18 16:18:22', 'updated_at' => '2018-11-18 16:18:22', ]);
        DB::table('groups')->insert(['id' => '23', 'name' => 'canalblockingtype', 'display_name' => 'canalblockingtype', 'created_at' => '2018-11-18 16:18:23', 'updated_at' => '2018-11-18 16:18:23', ]);
        DB::table('groups')->insert(['id' => '24', 'name' => 'status', 'display_name' => 'status', 'created_at' => '2018-11-18 16:18:23', 'updated_at' => '2018-11-18 16:18:23', ]);
        DB::table('groups')->insert(['id' => '25', 'name' => 'zonetype', 'display_name' => 'zonetype', 'created_at' => '2018-11-18 16:18:25', 'updated_at' => '2018-11-18 16:18:25', ]);
        DB::table('groups')->insert(['id' => '26', 'name' => 'type', 'display_name' => 'type', 'created_at' => '2018-11-18 16:18:26', 'updated_at' => '2018-11-18 16:18:26', ]);
        DB::table('groups')->insert(['id' => '27', 'name' => 'phu', 'display_name' => 'phu', 'created_at' => '2018-11-18 16:18:28', 'updated_at' => '2018-11-18 16:18:28', ]);
        DB::table('groups')->insert(['id' => '28', 'name' => 'organization', 'display_name' => 'organization', 'created_at' => '2018-11-18 16:18:29', 'updated_at' => '2018-11-18 16:18:29', ]);
        DB::table('groups')->insert(['id' => '29', 'name' => 'login', 'display_name' => 'login', 'created_at' => '2018-11-18 16:18:31', 'updated_at' => '2018-11-18 16:18:31', ]);
        DB::table('groups')->insert(['id' => '30', 'name' => 'user', 'display_name' => 'user', 'created_at' => '2018-11-18 16:18:31', 'updated_at' => '2018-11-18 16:18:31', ]);
        DB::table('groups')->insert(['id' => '31', 'name' => 'person', 'display_name' => 'person', 'created_at' => '2018-11-18 16:18:33', 'updated_at' => '2018-11-18 16:18:33', ]);
    }
}
