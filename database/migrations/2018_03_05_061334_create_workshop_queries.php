<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopQueries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_queries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workshop_id')->unsigned();
            $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('cascade');
            $table->string('subject');
            $table->text('message');
            $table->string('status');
            $table->boolean('is_resolved');
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
        Schema::table('workshop_queries', function (Blueprint $table) {
            $table->dropForeign('workshop_queries_workshop_id_foreign');
        });
        Schema::dropIfExists('workshop_queries');
    }
}
