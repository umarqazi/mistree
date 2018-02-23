<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBookingServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_service', function (Blueprint $table) {
            $table->string('name');
            $table->decimal('service_rate',11,2);
            $table->integer('service_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_service', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('service_rate',11,2);
            $table->dropColumn('service_time');
        });
    }
}
