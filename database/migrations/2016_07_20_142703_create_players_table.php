<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('category');
            $table->string('elo');
            $table->string('group');
            $table->string('gender');
            $table->string('asociation');
            $table->string('city');
            $table->string('country');
            $table->string('email');
            $table->string('phone');
            $table->string('accomday');
            $table->string('accomper');
            $table->string('lunch');
            $table->string('mess');
            $table->integer('tourid');
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
        Schema::drop('players');
    }
}
