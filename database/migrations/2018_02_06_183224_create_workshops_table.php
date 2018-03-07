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
            $table->string('owner_name');
            $table->unsignedInteger('jazzcash_id')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('cnic');
            $table->string('cnic_image',2048)->nullable();
            $table->string('mobile');
            $table->string('landline')->nullable();
            $table->enum('type',['Authorized', 'Unauthorized']);
            $table->unsignedInteger('slots')->default(1);
            $table->string('profile_pic',2048)->nullable();
            $table->time('open_time');
            $table->time('close_time');
            $table->boolean('is_approved')->default(0);
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
        Schema::drop('workshops');
    }
}
