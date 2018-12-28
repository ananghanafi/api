<?php

use Illuminate\Database\Seeder;

class MImplStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('m_impl_statuses')->insert([ 'id' => 1, 'status' => 'draft', 'remark' => 'Draft', ]);
        DB::table('m_impl_statuses')->insert([ 'id' => 2, 'status' => 'opened', 'remark' => 'Open', ]);
        DB::table('m_impl_statuses')->insert([ 'id' => 3, 'status' => 'onprogress', 'remark' => 'Dilaksanakan', ]);
        DB::table('m_impl_statuses')->insert([ 'id' => 4, 'status' => 'closed', 'remark' => 'Selesai', ]);
    }
}
