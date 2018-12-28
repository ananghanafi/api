<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCostColumnToCanalBlockPlansTable extends Migration
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
            $table->integer('cost')->nullable();
            $table->integer('funding_source')->nullable();
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
            $table->dropColumn('cost');
            $table->dropColumn('funding_source');
        });
    }
}
