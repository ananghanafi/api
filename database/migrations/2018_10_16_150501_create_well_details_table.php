<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWellDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('well_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id')->unique();
            $table->string('well_depth')->nullable();
            $table->string('peat_depth')->nullable();
            $table->string('well_debit')->nullable();
            $table->string('well_pressure')->nullable();
            $table->string('nearest_well')->nullable();
            $table->point('coordinate')->nullable();
            $table->string('utm_zone')->nullable();
            $table->integer('elevation')->nullable();
            $table->string('road_access')->nullable();
            $table->string('location_remark')->nullable();
            $table->string('detail_sketch')->nullable();
            $table->string('to_north')->nullable();
            $table->string('to_south')->nullable();
            $table->string('to_east')->nullable();
            $table->string('to_west')->nullable();
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
        Schema::dropIfExists('well_details');
    }
}
