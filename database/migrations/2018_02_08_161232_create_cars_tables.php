<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',45);
            $table->string('maker',45);
            $table->string('model',45);
            $table->string('year',45);
            $table->string('picture',45);
            $table->string('status',45);
            $table->timestamps();
        });
        Schema::create('cust_cars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cust_id')->unsigned()->unsigned();
            $table->foreign('cust_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('car_id')->unsigned()->nullable();
            $table->foreign('car_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('millage',45);
            $table->string('vehicle_no',45);
            $table->string('insurance',45);
            $table->string('status',45);
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
        Schema::dropIfExists('cars');
        Schema::dropIfExists('cust_cars');
        $table->dropForeign('cust_cars_cust_id_foreign');
        $table->dropForeign('cust_cars_car_id_foreign');
    }
}
