<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('type',45);
            $table->string('house_no',45);
            $table->string('street_no',45);
            $table->string('block',45);
            $table->string('area',45);
            $table->string('town',45);
            $table->string('city',45);
            $table->string('geo_cord',45)->nullable();
            $table->string('status');
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
        Schema::dropIfExists('customer_addresses');
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->dropForeign('customer_addresses_customer_id_foreign');
        });
    }
}
