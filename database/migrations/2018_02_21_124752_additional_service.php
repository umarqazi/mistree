<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdditionalService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned();
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->integer('workshop_service_id')->unsigned();
            $table->foreign('workshop_service_id')->references('id')->on('workshop_service');
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
        $table->dropForeign('billing_service_booking_id_foreign');
        $table->dropForeign('billing_service_workshop_service_id_foreign');
        Schema::dropIfExists('billing_service');
    }
}
