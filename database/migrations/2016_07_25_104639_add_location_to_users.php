<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /*Schema::table('users', function ($table) {
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');           
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('users', function ($table) {
            $table->dropForeign(['location_id']);
        });*/
    }
}
