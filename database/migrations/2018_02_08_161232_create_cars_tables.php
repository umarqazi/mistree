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
            $table->string('type')->nullable();
            $table->string('make');
            $table->string('model');
            $table->string('picture')->nullable();
            $table->boolean('is_published')->default(TRUE);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('car_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->string('millage');
            $table->string('vehicle_no');
            $table->string('insurance')->nullable()->default(FALSE);
            $table->string('year');
            $table->timestamp('removed_at')->nullable();
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
        Schema::table('car_customer', function (Blueprint $table) {
            $table->dropForeign('car_customer_customer_id_foreign');
            $table->dropForeign('car_customer_car_id_foreign');
        });
        Schema::dropIfExists('cars');
        Schema::dropIfExists('car_customer');
    }
}
