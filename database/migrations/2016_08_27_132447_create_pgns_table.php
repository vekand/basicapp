<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePgnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pgns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('eventu')->nullable();
            $table->string('siteu')->nullable();
            $table->string('dateu')->nullable();
            $table->string('roundu')->nullable();
            $table->string('resultu')->nullable();
            $table->string('whiteu')->nullable();
            $table->string('blacku')->nullable();
            $table->string('whiteelo')->nullable();
            $table->string('blackelo')->nullable();
            $table->string('adnotator')->nullable();
            $table->string('plycount')->nullable();
            $table->string('eventdate')->nullable();
            $table->string('eventtype')->nullable();
            $table->string('eventround')->nullable();
            $table->string('evcountry')->nullable();
            $table->string('eco')->nullable();
            $table->text('body')->nullable();
            $table->text('comment')->nullable();
            $table->string('fisier')->nullable();
            $table->integer('course_id')->nullable()->unsigned();
            $table->integer('diagram_id')->nullable()->unsigned();
            $table->string('feninitial')->nullable();
            $table->integer('userid')->nullable()->unsigned();
            $table->timestamps();
        });
          Schema::table('pgns', function ($table) {
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pgns', function ($table) {
            $table->dropForeign(['course_id']);
        });
        Schema::drop('pgns');
    }
}
