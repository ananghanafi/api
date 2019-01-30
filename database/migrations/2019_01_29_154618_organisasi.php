<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Organisasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country');
            $table->string('name');
            $table->string('upload');
            $table->string('key');
            $table->string('focal');
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
        Schema::dropIfExists('organisasi');
    }
}
