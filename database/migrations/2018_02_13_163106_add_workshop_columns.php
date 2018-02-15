<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkshopColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workshops', function($table) {
            $table->string('owner_name')->nullable();
            $table->string('cnic_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('workshops', function($table) {
            $table->dropColumn('owner_name');
            $table->dropColumn('cnic_image');
        });
    }
}
