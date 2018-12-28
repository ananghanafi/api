<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 50);
            $table->string('title_prefix')->nullable();
            $table->string('title_suffix')->nullable();
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->string('gender',1)->nullable();
            $table->string('religion')->nullable();
            $table->string('birth_place', 50)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('job_title')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('person');
    }
}
