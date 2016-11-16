<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipcurs');
            $table->date('datacurs');
            $table->string('fiscurs');
            $table->string('grupe');
            $table->string('starecurs');
            $table->integer('starecurs1');
            $table->integer('starecurs2');
            $table->string('starecurs3');
            $table->boolean('activ');
            $table->string('obscurs');
            $table->string('slug');
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('level_id')->nullable()->unsigned();
            $table->integer('tipcourse_id')->nullable()->unsigned();
            $table->integer('prof_id')->nullable()->unsigned();
            $table->string('gameeditor')->nullable();
            $table->string('playcomp')->nullable();
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
        Schema::drop('courses');
    }
}
