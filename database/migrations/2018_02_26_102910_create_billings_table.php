<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned();
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->integer('workshop_id')->unsigned();
            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->decimal('amount', 11, 2);            
            $table->decimal('paid_amount', 11, 2)->nullable();
            $table->decimal('lead_charges',7,2);
            $table->tinyInteger('ratings')->nullable();    
            $table->text('review')->nullable();
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
        Schema::table('billings', function(Blueprint $table){
            $table->dropForeign('billings_booking_id_foreign');
            $table->dropForeign('billings_workshop_id_foreign');
            $table->dropForeign('billings_customer_id_foreign');
        });
        Schema::dropIfExists('billings');
    }
}
