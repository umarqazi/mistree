<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_addresses', function (Blueprint $table) {
            $table->increments('id');                                    
            $table->integer('workshop_id')->unsigned();
            $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('cascade');
            $table->string('shop');
            $table->string('building')->nullable();
            $table->string('street')->nullable();
            $table->char('block', 4)->nullable();
            $table->string('town');
            $table->string('city');
            $table->string('coordinates')->nullable();
            $table->softDeletes();
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
        Schema::table('workshop_addresses', function (Blueprint $table) {
            $table->dropForeign('workshop_addresses_workshop_id_foreign');
        });
        Schema::dropIfExists('workshop_addresses');
    }
}
