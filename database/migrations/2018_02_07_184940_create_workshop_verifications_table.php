<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ws_id')->unsigned();
            $table->string('token');
            $table->foreign('ws_id')->references('id')->on('workshops')->onDelete('cascade');
        });
        Schema::table('workshops', function (Blueprint $table) {
            $table->boolean('is_verified')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("workshop_verifications");
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn('is_verified');
        });
    }
}
