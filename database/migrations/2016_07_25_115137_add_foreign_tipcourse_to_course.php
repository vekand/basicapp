<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignTipcourseToCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('courses', function ($table) {
            $table->foreign('tipcourse_id')->references('id')->on('tipcourses')->onDelete('cascade');           
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
            $table->dropForeign(['tipcourse_id']);
        });
    }
}
