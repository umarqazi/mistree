<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workshops', function (Blueprint $table) {
            $table->boolean('is_approved')->default(0);
        });

        Schema::table('workshop_specialties', function (Blueprint $table) {
            $table->string('status',45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropcolumn('is_approved');
        });

        Schema::table('workshop_specialties', function (Blueprint $table) {
            $table->dropcolumn('status');
        });
    }
}
