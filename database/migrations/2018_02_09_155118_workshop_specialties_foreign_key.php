<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkshopSpecialtiesForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workshop_service', function (Blueprint $table) {
            $table->integer('service_id')->unsigned()->change();
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workshop_service', function(Blueprint $table)
        {
            $table->dropForeign('workshop_service_service_id_foreign');
            $table->dropColumn('service_id');
        });
    }
}
