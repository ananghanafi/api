<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUprgAndLatLngColumnToRestOfTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('construction_plan', function (Blueprint $table) {
            //
            $table->integer('uprg_id')->nullable()->unsigned();
        });
        Schema::table('construction_impl', function (Blueprint $table) {
            //
            $table->integer('uprg_id')->nullable()->unsigned();
        });
        Schema::table('canal_block_plans', function (Blueprint $table) {
            //
            $table->integer('uprg_id')->nullable()->unsigned();
            $table->string('uprg_text')->nullable();
            $table->string('uprg_slug')->nullable();
            $table->float('lat', 10, 6)->nullable();
            $table->float('lng', 10, 6)->nullable();
        });
        Schema::table('canal_block_impl', function (Blueprint $table) {
            //
            $table->integer('uprg_id')->nullable()->unsigned();
            $table->string('uprg_text')->nullable();
            $table->string('uprg_slug')->nullable();
            $table->float('lat', 10, 6)->nullable();
            $table->float('lng', 10, 6)->nullable();
        });
        Schema::table('canal_hoarding_plans', function (Blueprint $table) {
            //
            $table->integer('uprg_id')->nullable()->unsigned();
            $table->string('uprg_text')->nullable();
            $table->string('uprg_slug')->nullable();
            $table->float('lat', 10, 6)->nullable();
            $table->float('lng', 10, 6)->nullable();
        });
        Schema::table('canal_hoarding_impl', function (Blueprint $table) {
            //
            $table->integer('uprg_id')->nullable()->unsigned();
            $table->string('uprg_text')->nullable();
            $table->string('uprg_slug')->nullable();
            $table->float('lat', 10, 6)->nullable();
            $table->float('lng', 10, 6)->nullable();
        });
        Schema::table('revegetation_plans', function (Blueprint $table) {
            //
            $table->integer('uprg_id')->nullable()->unsigned();
            $table->string('uprg_text')->nullable();
            $table->string('uprg_slug')->nullable();
            $table->float('lat', 10, 6)->nullable();
            $table->float('lng', 10, 6)->nullable();
        });
        Schema::table('revegetation_impl', function (Blueprint $table) {
            //
            $table->integer('uprg_id')->nullable()->unsigned();
            $table->string('uprg_text')->nullable();
            $table->string('uprg_slug')->nullable();
            $table->float('lat', 10, 6)->nullable();
            $table->float('lng', 10, 6)->nullable();
        });
        Schema::table('revitalization_plans', function (Blueprint $table) {
            //
            $table->integer('uprg_id')->nullable()->unsigned();
            $table->string('uprg_text')->nullable();
            $table->string('uprg_slug')->nullable();
            $table->renameColumn('x', 'lat');
            $table->renameColumn('y', 'lng');
        });
        Schema::table('revitalization_impl', function (Blueprint $table) {
            //
            $table->integer('uprg_id')->nullable()->unsigned();
            $table->string('uprg_text')->nullable();
            $table->string('uprg_slug')->nullable();
            $table->renameColumn('x', 'lat');
            $table->renameColumn('y', 'lng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('construction_plan', function (Blueprint $table) {
            //
            $table->dropColumn(['uprg_id']);
        });
        Schema::table('construction_impl', function (Blueprint $table) {
            //
            $table->dropColumn(['uprg_id']);
        });
        Schema::table('canal_block_plans', function (Blueprint $table) {
            //
            $table->dropColumn(['uprg_id','uprg_text','uprg_slug','lat','lng']);
        });
        Schema::table('canal_block_impl', function (Blueprint $table) {
            //
            $table->dropColumn(['uprg_id','uprg_text','uprg_slug','lat','lng']);
        });
        Schema::table('canal_hoarding_plans', function (Blueprint $table) {
            //
            $table->dropColumn(['uprg_id','uprg_text','uprg_slug','lat','lng']);
        });
        Schema::table('canal_hoarding_impl', function (Blueprint $table) {
            //
            $table->dropColumn(['uprg_id','uprg_text','uprg_slug','lat','lng']);
        });
        Schema::table('revegetation_plans', function (Blueprint $table) {
            //
            $table->dropColumn(['uprg_id','uprg_text','uprg_slug','lat','lng']);
        });
        Schema::table('revegetation_impl', function (Blueprint $table) {
            //
            $table->dropColumn(['uprg_id','uprg_text','uprg_slug','lat','lng']);
        });
        Schema::table('revitalization_plans', function (Blueprint $table) {
            //
            $table->dropColumn(['uprg_id','uprg_text','uprg_slug']);
            $table->renameColumn('lat','x');
            $table->renameColumn('lng','y');
        });
        Schema::table('revitalization_impl', function (Blueprint $table) {
            //
            $table->dropColumn(['uprg_id','uprg_text','uprg_slug']);
            $table->renameColumn('lat','x');
            $table->renameColumn('lng','y');
        });
    }
}
