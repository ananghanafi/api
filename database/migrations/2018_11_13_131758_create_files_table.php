<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mod', 25);
            $table->string('mod_type', 25)->nullable();
            $table->string('path', 250);
            $table->string('category_slug', 200)->nullable();
            $table->string('category', 200)->nullable();
            $table->string('file_name', 50);
            $table->string('file_type', 5);
            $table->string('file_desc', 100)->nullable();
            $table->integer('size')->unsigned();
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
        Schema::dropIfExists('files');
    }
}
