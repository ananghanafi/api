<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImplProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impl_progress', function (Blueprint $table) {
            $table->string('activity_type', 25);
            $table->integer('impl_id')->unsigned();
            $table->string('periods', 7);
            $table->decimal('physical_pct', 5, 2);
            $table->decimal('cost_pct', 5, 2);
            $table->integer('cost');
            $table->string('remark')->nullable();

            $table->primary(['activity_type', 'impl_id', 'periods']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('impl_progress');
    }
}
