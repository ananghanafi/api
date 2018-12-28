<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetDefaultNameOnCanalBlockPlansTable extends Migration
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
            $table->string('name', 50)->nullable()->default("Pembangunan Sekat Kanal")->change();
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
            $table->string('name', 50)->nullable()->change();
        });
    }
}
