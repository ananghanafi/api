<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanalBlockImplTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canal_block_impl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned();
            $table->string('code', 25)->unique();
            $table->string('name', 50)->nullable();
            $table->integer('cost')->nullable();
            $table->integer('funding_source')->nullable();
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
        Schema::dropIfExists('canal_block_impl');
    }
}
