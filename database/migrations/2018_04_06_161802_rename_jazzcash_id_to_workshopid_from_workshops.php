<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameJazzcashIdToWorkshopidFromWorkshops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workshops', function(Blueprint $table){
            DB::statement('ALTER TABLE workshops CHANGE jazzcash_id workshopId INT(10)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workshops', function(Blueprint $table){
            DB::statement('ALTER TABLE workshops CHANGE workshopId jazzcash_id INT(10)');
        });
    }
}
