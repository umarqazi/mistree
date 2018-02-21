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
            $table->integer('customer_car_id')->unsigned();
            $table->foreign('customer_car_id')->references('id')->on('car_customer');
            $table->date('job_date');
            $table->time('job_time');
            $table->string('response');
            $table->string('job_status');
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
            $table->dropForeign('bookings_customer_car_id_foreign');        
        });
        Schema::dropIfExists('bookings');
    }
}
