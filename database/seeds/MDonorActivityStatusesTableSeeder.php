<?php

use Illuminate\Database\Seeder;

class MDonorActivityStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('m_donor_activity_statuses')->insert([
            'id' => 1,
            'status' => 'draft',
            'remark' => 'DRAFT',
        ]);
        DB::table('m_donor_activity_statuses')->insert([
            'id' => 2,
            'status' => 'confirmed',
            'remark' => 'Confirmed',
        ]);
        DB::table('m_donor_activity_statuses')->insert([
            'id' => 3,
            'status' => 'on-going',
            'remark' => 'DRAFT',
        ]);
        DB::table('m_donor_activity_statuses')->insert([
            'id' => 4,
            'status' => 'finalization',
            'remark' => 'Finalization',
        ]);
        DB::table('m_donor_activity_statuses')->insert([
            'id' => 5,
            'status' => 'not-pursued',
            'remark' => 'Not Pursued',
        ]);
        DB::table('m_donor_activity_statuses')->insert([
            'id' => 6,
            'status' => 'completed',
            'remark' => 'Completed',
        ]);
        DB::table('m_donor_activity_statuses')->insert([
            'id' => 7,
            'status' => 'inception',
            'remark' => 'Inception',
        ]);
        DB::table('m_donor_activity_statuses')->insert([
            'id' => 8,
            'status' => 'agreement-finalization',
            'remark' => 'Agreement Finalization',
        ]);
        DB::table('m_donor_activity_statuses')->insert([
            'id' => 9,
            'status' => 'finished',
            'remark' => 'Finished',
        ]);
        DB::table('m_donor_activity_statuses')->insert([
            'id' => 10,
            'status' => 'terminated',
            'remark' => 'Terminated',
        ]);
    }
}
