<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanalBlockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canal_block_details', function (Blueprint $table) {
            $table->integer('activity_id')->unique();
            $table->string('utm_zone')->nullable();
            $table->integer('elevation')->nullable();
            $table->string('road_access')->nullable();
            $table->string('location_remark')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('exec_team', 50)->nullable();
            $table->integer('exec_team_category')->nullable();
            $table->string('exec_team_remark', 200)->nullable();
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
        Schema::dropIfExists('canal_block_details');
    }
}
