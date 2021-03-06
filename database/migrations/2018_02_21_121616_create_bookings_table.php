<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('workshop_id')->unsigned();
            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->references('id')->on('cars');
            $table->date('job_date');
            $table->time('job_time');
            $table->boolean('is_accepted')->default(0);
            $table->string('job_status');
            $table->string('vehicle_no');
            $table->unsignedInteger('loyalty_points')->default(0);
            $table->string('millage')->nullable();
            $table->boolean('is_doorstep')->default(0);
            $table->integer('customer_address_id')->unsigned();
            $table->foreign('customer_address_id')->references('id')->on('customer_addresses');
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
        Schema::table('bookings', function(Blueprint $table){
            $table->dropForeign('bookings_customer_id_foreign');
            $table->dropForeign('bookings_workshop_id_foreign');
            $table->dropForeign('bookings_car_id_foreign');     
            $table->dropForeign('bookings_customer_address_id_foreign');   
        });
        Schema::dropIfExists('bookings');
    }
}
