<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetDefaultUnitAndStatusOnCanalBlockAndHoardingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('canal_block_plans', function (Blueprint $table) {
            //
            $table->integer('unit')->nullable()->default(1)->change();
            $table->integer('status')->nullable()->default(1)->change();
        });
        Schema::table('canal_block_impl', function (Blueprint $table) {
            //
            $table->integer('unit')->nullable()->default(1)->change();
            $table->integer('status')->nullable()->default(1)->change();
        });
        Schema::table('canal_hoarding_plans', function (Blueprint $table) {
            //
            $table->integer('status')->nullable()->default(1)->change();
        });
        Schema::table('canal_hoarding_impl', function (Blueprint $table) {
            //
            $table->integer('status')->nullable()->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('canal_block_plans', function (Blueprint $table) {
            //
            $table->integer('unit')->nullable()->change();
            $table->integer('status')->nullable()->change();
        });
        Schema::table('canal_block_impl', function (Blueprint $table) {
            //
            $table->integer('unit')->nullable()->change();
            $table->integer('status')->nullable()->change();
        });
        Schema::table('canal_hoarding_plans', function (Blueprint $table) {
            //
            $table->integer('status')->nullable()->change();
        });
        Schema::table('canal_hoarding_impl', function (Blueprint $table) {
            //
            $table->integer('status')->nullable()->change();
        });
    }
}
