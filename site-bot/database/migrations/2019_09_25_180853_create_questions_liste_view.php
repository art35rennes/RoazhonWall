<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsListeView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW questions_liste
        AS
        SELECT questions.id,questions.text, COUNT(answers.id) AS reponses, answers.image, questions.updated_at
        FROM `questions` 
        LEFT JOIN answers on questions.id = answers.id_question 
        GROUP BY questions.id
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions_liste_view');
    }
}
