<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExecTeamOnWellDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('well_details', function (Blueprint $table) {
            //
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('exec_team', 50)->nullable();
            $table->integer('exec_team_category')->nullable();
            $table->string('exec_team_remark', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('well_details', function (Blueprint $table) {
            //
            $table->dropColumn(['start_date', 'end_date', 'exec_team', 'exec_team_category', 'exec_team_remark']);
        });
    }
}
