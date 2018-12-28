<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUprgColumnToConstructionPlanTable extends Migration
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
            $table->string('uprg_text')->nullable();
            $table->string('uprg_slug')->nullable();
            $table->float('lat', 10, 6)->nullable();
            $table->float('lng', 10, 6)->nullable();
        });
        Schema::table('construction_impl', function (Blueprint $table) {
            //
            $table->string('uprg_text')->nullable();
            $table->string('uprg_slug')->nullable();
            $table->float('lat', 10, 6)->nullable();
            $table->float('lng', 10, 6)->nullable();
            $table->string('year', 4)->nullable();
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
            $table->dropColumn('uprg_text');
            $table->dropColumn('uprg_slug');
            $table->dropColumn('lat');
            $table->dropColumn('lng');
        });
        Schema::table('construction_impl', function (Blueprint $table) {
            //
            $table->dropColumn('uprg_text');
            $table->dropColumn('uprg_slug');
            $table->dropColumn('lat');
            $table->dropColumn('lng');
            $table->dropColumn('year');
        });
    }
}
