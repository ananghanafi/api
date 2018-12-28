<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name', 100);
            $table->polygon('area')->nullable();
            $table->string('year', 4)->nullable();
            $table->float('total_area', 16, 10)->nullable();
            $table->integer('phu_type')->nullable();
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
        Schema::dropIfExists('phu');
    }
}
