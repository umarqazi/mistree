<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomersAndWorkshopsTablesAddFcmToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('fcm_token')->nullable();
        });
        Schema::table('workshops', function (Blueprint $table) {
            $table->string('fcm_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn('fcm_token');
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('fcm_token');
        });
    }
}
