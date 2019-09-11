<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAskedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('askeds', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->bigInteger('id_game')->index();
            $table->bigInteger('id_question');
            $table->foreign('id_game')->references('id')->on('games');
            $table->foreign('id_question')->references('id')->on('questions');
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
        Schema::dropIfExists('asked');
    }
}
