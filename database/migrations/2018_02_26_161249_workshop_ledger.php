<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkshopLedger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_ledgers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->nullable()->unsigned();
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->integer('workshop_id')->unsigned();
            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->unsignedInteger('transaction_parent')->default(0);
            $table->string('transaction_type');
            $table->decimal('amount', 11, 2);            
            $table->decimal('adjusted_balance', 11, 2);
            $table->decimal('unadjusted_balance', 11, 2);
            $table->timestamps();
        });

        Schema::create('workshop_balances', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('workshop_id')->unsigned();
            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->decimal('balance', 11, 2);
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
        Schema::table('workshop_ledgers', function(Blueprint $table){
            $table->dropForeign('workshop_ledgers_booking_id_foreign');
            $table->dropForeign('workshop_ledgers_workshop_id_foreign');
        });
        Schema::dropIfExists('workshop_ledgers');

        Schema::table('workshop_balances', function(Blueprint $table){            
            $table->dropForeign('workshop_balances_workshop_id_foreign');            
        });
        Schema::dropIfExists('workshop_balances');

    }
}
