<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstructionPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construction_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('code');
            $table->integer('type')->nullable();
            $table->integer('unit')->default(1);
            $table->integer('affected_area')->nullable();
            $table->integer('zone_type')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('funding_source')->nullable();
            $table->string('remark')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('sub_district_id')->nullable();
            $table->string('village')->nullable();
            $table->integer('peat_hydrological_unity')->nullable();
            $table->point('coordinate')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->string('year', 4)->nullable();
            $table->integer('submitted_by')->nullable();
            $table->integer('approved_by')->nullable();
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
        Schema::dropIfExists('construction_plan');
    }
}
