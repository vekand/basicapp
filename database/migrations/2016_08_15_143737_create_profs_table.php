<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('email')->unique();
            $table->string('adresa')->nullable();
            $table->string('oras')->nullable();
            $table->string('scoala')->nullable();
            $table->boolean('activ');
            $table->boolean('blog');
            $table->string('text');
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
        Schema::drop('profs');
    }
}
