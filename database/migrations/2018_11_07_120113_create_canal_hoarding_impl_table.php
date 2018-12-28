<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanalHoardingImplTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canal_hoarding_impl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned();
            $table->string('code', 25);
            $table->string('name', 100)->default("Penimbunan Kanal");
            $table->integer('cost')->nullable();
            $table->integer('funding_source')->nullable();
            $table->integer('phu_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('sub_district_id')->nullable();
            $table->string('village')->nullable();
            $table->float('length', 16, 10)->nullable();
            $table->string('year', 4)->nullable();
            $table->string('remark')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('canal_hoarding_impl');
    }
}
