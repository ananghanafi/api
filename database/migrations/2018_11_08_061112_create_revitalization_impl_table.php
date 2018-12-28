<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevitalizationImplTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revitalization_impl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned();
            $table->string('code')->unique();
            $table->string('name')->default('Revitalisasi');
            $table->integer('cost')->nullable();
            $table->integer('funding_source')->nullable()->unsigned();
            $table->integer('phu_id')->nullable()->unsigned();
            $table->integer('province_id')->nullable()->unsigned();
            $table->integer('city_id')->nullable()->unsigned();
            $table->integer('sub_district_id')->nullable()->unsigned();
            $table->string('village')->nullable();
            $table->integer('r1_1_unit')->default(0);
            $table->integer('r1_2_unit')->default(0);
            $table->integer('r1_3_m')->default(0);
            $table->integer('r1_4_unit')->default(0);
            $table->integer('r2_1_ha')->default(0);
            $table->integer('r2_2_ha')->default(0);
            $table->integer('r2_3_ha')->default(0);
            $table->string('year', 4)->nullable();
            $table->string('remark')->nullable();
            $table->float('x', 10, 6)->nullable();
            $table->float('y', 10, 6)->nullable();
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
        Schema::dropIfExists('revitalization_impl');
    }
}
