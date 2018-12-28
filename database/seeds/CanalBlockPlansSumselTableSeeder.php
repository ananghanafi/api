<?php

use Illuminate\Database\Seeder;

class CanalBlockPlansSumselTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // province_id 21
        DB::table('canal_block_plans')->insert([ 'id' => '5371', 'code' => '2018_R1.2_16_00309', 'phu_id' => '82', 'province_id' => '21', 'city_id' => '2102', 'sub_district_id' => '2102023', 'village' => 'SUMBER HIDUP', 'canal_type' => '6', 'canal_blocking_type' => '2', 'uprg_text' => 'PT. TELAGA HIKMAH', 'uprg_slug' => '4-th', 'lat' => '105.03259', 'lng' => '-3.56493', 'remark' => '', 'year' => '2018', ]);
    }
}
