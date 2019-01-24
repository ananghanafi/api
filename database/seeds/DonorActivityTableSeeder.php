<?php

use Illuminate\Database\Seeder;

class DonorActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('donor_activities')->insert([
            'id' => 1,
            'title'=>'Judul',
            'summary' => 'Kegiatan',
            'start_date'=>'2018-11-18 16:17:41',
            'end_date'=>'2019-11-18 16:17:41',
            'amount'=>5000,
            'currency'=>5000,
            'funding_source'=> 5000,
            'implementing_agency'=> 20,
            'remark'=> 'Remark',
            'year'=>'2018',
            'province_id' => 14 ,
            'city_id' => 1402,
            'sub_district_id' => 1401001,
            'village' => 140100111,
            'x' => 107.44,
            'y' => 107.44,
            'status' => 0,
        ]);
        DB::table('donor_activities')->insert([
            'id' => 2,
            'title'=>'Judul',
            'summary' => 'Kegiatan',
            'start_date'=>'2018-11-18 16:17:41',
            'end_date'=>'2019-11-18 16:17:41',
            'amount'=>5000,
            'currency'=>5000,
            'funding_source'=> 5000,
            'implementing_agency'=> 20,
            'remark'=> 'Remark',
            'year'=>'2018',
            'province_id' => 14 ,
            'city_id' => 1402,
            'sub_district_id' => 1401002,
            'village' => 140100111,
            'x' => 107.44,
            'y' => 107.44,
            'status' => 0,
        ]);
        DB::table('donor_activities')->insert([
            'id' => 3,
            'title'=>'Judul',
            'summary' => 'Kegiatan',
            'start_date'=>'2018-11-18 16:17:41',
            'end_date'=>'2019-11-18 16:17:41',
            'amount'=>5400,
            'currency'=>5300,
            'funding_source'=> 5000,
            'implementing_agency'=> 20,
            'remark'=> 'Remark',
            'year'=>'2018',
            'province_id' => 14 ,
            'city_id' => 1402,
            'sub_district_id' => 1401001,
            'village' => 140100111,
            'x' => 107.44,
            'y' => 107.44,
            'status' => 0,
        ]);
        DB::table('donor_activities')->insert([
            'id' => 4,
            'title'=>'Judul',
            'summary' => 'Kegiatan',
            'start_date'=>'2018-11-18 16:17:41',
            'end_date'=>'2019-11-18 16:17:41',
            'amount'=>5000,
            'currency'=>5000,
            'funding_source'=> 5000,
            'implementing_agency'=> 20,
            'remark'=> 'Remark',
            'year'=>'2018',
            'province_id' => 14 ,
            'city_id' => 1402,
            'sub_district_id' => 1401001,
            'village' => 140100111,
            'x' => 107.44,
            'y' => 107.44,
            'status' => 0,
        ]);
    }
}
