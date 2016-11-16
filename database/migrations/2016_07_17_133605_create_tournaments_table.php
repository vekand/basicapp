<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descriere');
            $table->date('posted_at');
            $table->string('perioada');
            $table->string('prospect');
            $table->string('slug');
            $table->integer('nrrunde');
            $table->string('localit');
            $table->string('tara');
            $table->string('locatie2');
            $table->integer('stare1');
            $table->integer('stare2');
            $table->string('stare');
            $table->boolean('activ');
            $table->string('obs');
            $table->string('chesssite');
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('prof_id')->nullable()->unsigned();
            $table->integer('userid')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tournaments');
    }
}
