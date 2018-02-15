<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::dropIfExists('addresses');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cust_id')->unsigned();
            $table->foreign('cust_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->integer('ws_id')->unsigned();
            $table->foreign('ws_id')->references('id')->on('workshops')->onDelete('cascade');
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
}
