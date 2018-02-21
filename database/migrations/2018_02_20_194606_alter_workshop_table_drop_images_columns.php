<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterWorkshopTableDropImagesColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workshops', function(Blueprint $table){
            $table->dropColumn('pic1');
            $table->dropColumn('pic2');
            $table->dropColumn('pic3');
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
            $table->string('pic1',45)->after('profile_pic');
            $table->string('pic2',45)->after('pic1');
            $table->string('pic3',45)->after('pic2');
        });
    }
}
