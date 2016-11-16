<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('diagram_id')->nullable()->unsigned();
            $table->string('mutarefena')->nullable();
            $table->string('mutarefenn')->nullable();
            $table->string('mutarepgn')->nullable();
            $table->string('unicpgn')->nullable();
            $table->boolean('alb');
            $table->integer('mutare')->nullable()->unsigned();
            $table->text('body')->nullable();
            $table->text('comment')->nullable();
            $table->integer('clickuri')->nullable()->unsigned();
            $table->integer('userid')->nullable()->unsigned();
            $table->timestamps();
        });

          Schema::table('moves', function ($table) {
            $table->foreign('diagram_id')->references('id')->on('diagrams')->onDelete('cascade');           
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('moves', function ($table) {
            $table->dropForeign(['diagram_id']);

        });
        Schema::drop('moves');
    }
}
