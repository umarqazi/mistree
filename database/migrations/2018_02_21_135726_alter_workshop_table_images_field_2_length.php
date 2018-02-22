<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterWorkshopTableImagesField2Length extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('workshops', function($table) {
            $table->string('profile_pic',300)->nullable()->change();
            $table->string('cnic_image',300)->nullable()->change();
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
                    $table->string('profile_pic',300)->change();
                    $table->string('cnic_image',300)->change();
                });
    }
}
