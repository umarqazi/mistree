<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnJwtTokenToCustomersWorkshopsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table){
            $table->string('jwt_token', 1024)->nullable();
        });
        Schema::table('workshops', function (Blueprint $table){
            $table->string('jwt_token', 1024)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workshops', function (Blueprint $table){
            $table->dropColumn('jwt_token');
        });
        Schema::table('customers', function (Blueprint $table){
            $table->dropColumn('jwt_token');
        });
    }
}
