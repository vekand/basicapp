<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagrams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->nullable()->unsigned();
            $table->string('feninitial')->nullable();
            $table->string('fenfinal')->nullable();
            $table->string('explicatii')->nullable();
            $table->boolean('alb');
            $table->string('grupe')->nullable();
            $table->integer('grupa')->nullable()->unsigned();
            $table->integer('acasa')->nullable()->unsigned();
            $table->integer('prof_id')->nullable()->unsigned();
            $table->text('body')->nullable();
            $table->integer('clickuri')->nullable()->unsigned();
            $table->integer('userid')->nullable()->unsigned();
            $table->timestamps();
        });

        // create foreign
        Schema::table('diagrams', function ($table) {
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diagrams', function ($table) {
            $table->dropForeign(['course_id']);
        });
        Schema::drop('diagrams');
    }
}
