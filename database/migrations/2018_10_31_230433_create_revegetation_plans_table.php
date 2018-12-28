<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevegetationPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revegetation_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 25)->unique();
            $table->string('name', 50)->default('Kegiatan Revegetasi');
            $table->integer('cost')->nullable();
            $table->integer('funding_source')->nullable();
            $table->integer('phu_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('sub_district_id')->nullable();
            $table->string('village')->nullable();
            $table->integer('burn_status')->nullable();
            $table->integer('vegetation_density')->nullable();
            $table->integer('revegetation_type')->nullable();
            $table->float('total_area', 16, 10)->nullable();
            $table->string('year', 4)->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revegetation_plans');
    }
}
