<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donor_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('summary')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('amount')->unsigned()->nullable();
            $table->integer('currency')->unsigned()->default(1);
            $table->integer('funding_source')->unsigned()->nullable();
            $table->integer('implementing_agency')->unsigned()->nullable();
            $table->string('year', 4)->nullable();
            $table->string('remark')->nullable();
            $table->integer('province_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('sub_district_id')->unsigned()->nullable();
            $table->integer('village_id')->unsigned()->nullable();
            $table->string('village')->nullable();
            $table->float('x', 10, 6)->nullable();
            $table->float('y', 10, 6)->nullable();
            $table->integer('status')->unsigned()->default(1);
            $table->timestamps();
        });
        Schema::create('donor_activity_phu', function (Blueprint $table) {
            $table->integer('project_id')->unsigned();
            $table->integer('phu_id')->unsigned();
        });
        Schema::create('m_donor_activity_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('remark')->nullable();
        });
        Schema::create('donor_activity_brg_mandat', function (Blueprint $table) {
            $table->integer('project_id')->unsigned();
            $table->integer('mandat_id')->unsigned();
        });
        Schema::create('m_brg_mandat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('desc_id');
            $table->string('desc_en')->nullable();
        });
        Schema::create('m_currency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->index();
            $table->string('name');
            $table->string('symbol', 25);
            $table->boolean('is_active')->default(false);
        });
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donor_activities');
        Schema::dropIfExists('donor_activity_phu');
        Schema::dropIfExists('donor_activity_brg_mandat');
        Schema::dropIfExists('m_donor_activity_statuses');
        Schema::dropIfExists('m_brg_mandat');
        Schema::dropIfExists('m_currency');
    }
}
