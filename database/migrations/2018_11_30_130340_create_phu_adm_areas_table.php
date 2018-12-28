<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhuAdmAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phu_adm_areas', function (Blueprint $table) {
            $table->integer('phu_id')->unsigned();
            $table->morphs('adm_area');

            $table->primary(['phu_id', 'adm_area_id', 'adm_area_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phu_adm_areas');
    }
}
