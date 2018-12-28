<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanalBlockPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canal_block_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 25)->unique();
            $table->string('name', 50)->nullable();
            $table->integer('canal_type')->nullable();
            $table->integer('canal_blocking_type')->nullable();
            $table->integer('phu_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('sub_district_id')->nullable();
            $table->string('village', 50)->nullable();
            $table->string('remark')->nullable();
            $table->string('year', 4)->nullable();
            $table->integer('unit')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('canal_block_plans');
    }
}
