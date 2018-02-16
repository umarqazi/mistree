<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::table('admins', function($table) {
            $table->string('con_number',45)->nullable()->change();
            $table->string('status')->nullable()->change();
        });

          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::table('admins', function($table) {

             $table->string('con_number',45);
             $table->string('status');
         });



    }
}
