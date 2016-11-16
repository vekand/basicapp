<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->integer('user_id')->nullable()->unsigned();
            $table->boolean('vizibil');
            $table->boolean('publicu');
            $table->string('fisier')->nullable();
            $table->integer('prof_id')->nullable()->unsigned();
            $table->integer('userid')->nullable()->unsigned();
            $table->timestamps();
        });


        // create foreign
        Schema::table('posts', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('posts', function ($table) {
            $table->dropForeign(['user_id']);
        });
        Schema::drop('posts');
    }
}
