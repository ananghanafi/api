<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnToOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            //
            $table->renameColumn('type', 'org_type');
            $table->string('short_name', 50)->change();
            $table->string('full_name', 100)->change();
            $table->string('address', 200)->nullable();
            $table->string('work_scope', 25)->nullable();
            $table->integer('area_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            //
            $table->renameColumn('org_type', 'type');
            $table->string('short_name', 20)->change();
            $table->string('full_name', 50)->change();
            $table->dropColumn(['address', 'work_scope', 'area_id']);
        });
    }
}
