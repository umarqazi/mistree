<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnStreetNoFromCustomerAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_addresses', function(Blueprint $table){
            DB::statement('ALTER TABLE customer_addresses CHANGE street_no street VARCHAR(191)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_addresses', function(Blueprint $table){
            DB::statement('ALTER TABLE customer_addresses CHANGE street street_no VARCHAR(191)');

        });
    }
}
