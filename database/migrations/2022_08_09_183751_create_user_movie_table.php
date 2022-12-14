<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMovieTable extends Migration
{

    public function up()
    {
        Schema::create('user_movie', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('movie_id');

            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }


    public function down()
    {
        Schema::dropIfExists('user_movie');
    }
}
