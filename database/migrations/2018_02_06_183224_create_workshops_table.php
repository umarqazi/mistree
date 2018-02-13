<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('card_number',45);
            $table->string('con_number',45);
            $table->string('type',45);
            $table->string('profile_pic',45);
            $table->string('pic1',45);
            $table->string('pic2',45);
            $table->string('pic3',45);
            $table->string('geo_cord',45)->nullable();
            $table->string('team_slot',45);
            $table->string('open_time',45);
            $table->string('close_time',45);
            $table->string('status',45);
            $table->rememberToken();
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
        Schema::drop('workshops');
    }
}
