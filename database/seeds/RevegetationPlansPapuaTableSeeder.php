<?php

use Illuminate\Database\Seeder;

class RevegetationPlansPapuaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('revegetation_plans')->insert(['id' => '1860' , 'phu_id' => '312', 'province_id' => '73', 'city_id' => '7313', 'sub_district_id' => '7313002', 'village' => 'LINGGUA', 'burn_status' => '1', 'vegetation_density' => '3', 'revegetation_type' => '1', 'total_area' => '34.73672', 'year' => '2018', 'remark' => 'Area Daratan ; Fungsi Kawasan HPT', 'code' => '2018_R2_94_00003', ]);
        DB::table('revegetation_plans')->insert(['id' => '1861' , 'phu_id' => '312', 'province_id' => '73', 'city_id' => '7313', 'sub_district_id' => '7313002', 'village' => 'LINGGUA', 'burn_status' => '1', 'vegetation_density' => '2', 'revegetation_type' => '2', 'total_area' => '1815.46514', 'year' => '2018', 'remark' => 'Area Daratan ; Fungsi Kawasan HPT', 'code' => '2018_R2_94_00001', ]);
        DB::table('revegetation_plans')->insert(['id' => '1862' , 'phu_id' => '312', 'province_id' => '73', 'city_id' => '7313', 'sub_district_id' => '7313001', 'village' => 'WANGGATE', 'burn_status' => '1', 'vegetation_density' => '1', 'revegetation_type' => '3', 'total_area' => '1207.55994', 'year' => '2018', 'remark' => 'Area Daratan - Kampung Gadom/Wanggate ; Fungsi Kawasan HPT', 'code' => '2018_R2_94_00002', ]);
    }
}
