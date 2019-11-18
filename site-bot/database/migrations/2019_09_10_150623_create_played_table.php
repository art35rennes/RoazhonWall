<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playeds', function (Blueprint $table) {
            $table->bigInteger('id_game')->index();
            $table->bigInteger('id_player')->index();
            $table->primary(['id_game', 'id_player']);
            $table->foreign('id_game')->references('id')->on('games');
            $table->foreign('id_player')->references('id')->on('players');
            $table->integer('score')->default(0);
            $table->enum('type', ['challenger', 'joueur', 'joueur_c'])->default('joueur');
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
        Schema::dropIfExists('played');
    }
}
