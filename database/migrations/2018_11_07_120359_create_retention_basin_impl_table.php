<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetentionBasinImplTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retention_basin_impl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned();
            $table->string('code', 25)->unique();
            $table->string('name', 50)->default('Pembuatan Embung');
            $table->integer('cost')->nullable();
            $table->integer('funding_source')->nullable()->unsigned();
            $table->integer('phu_id')->nullable()->unsigned();
            $table->integer('province_id')->nullable()->unsigned();
            $table->integer('city_id')->nullable()->unsigned();
            $table->integer('sub_district_id')->nullable()->unsigned();
            $table->string('village')->nullable();
            $table->string('year', 4)->nullable();
            $table->string('remark')->nullable();
            $table->string('uprg_text')->nullable();
            $table->string('uprg_slug')->nullable();
            $table->integer('uprg_id')->nullable()->unsigned();
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
        Schema::dropIfExists('retention_basin_impl');
    }
}
