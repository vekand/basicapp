<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLevelToCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        Schema::table('courses', function ($table) {
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');           
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('courses', function ($table) {
            $table->dropForeign(['level_id']);
        });
    }
}
