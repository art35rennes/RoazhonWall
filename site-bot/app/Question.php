<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'text' => 'string',
        'image' => 'string',
    ];

    static public function getQuestions($id=null){
        if($id != null){
            $question = DB::table('questions')
                ->select(['id','text','image','updated_at'])
                ->where('id', "=",$id)
                ->get();
            $answer = DB::table("answers")
                ->select(['id', 'text', 'image', 'true', 'updated_at'])
                ->where('id_question', "=", $id)
                ->get();

            return ["question" => $question, "answer" => $answer ];
        }
        else{
            return DB::table('questions')
                ->select(['id','text','image'])
                ->get();
        }

    }

    static public function getLastIdQuestion(){
        return DB::table('questions')
            ->select('id')
            ->orderBy('created_at','desc')
            ->get()[0]->id;
    }

    static public function getQuestionsListe(){
//        dd( DB::table('questions_liste')->select()->get());
        return DB::table('questions_liste')->select()->get();
    }

    static public function setRandomQuestion(){
        $idGame = Game::getCurrentGame()->id;
        $id = DB::select(DB::raw("
            SELECT DISTINCT questions.id FROM questions 
            LEFT JOIN (SELECT * FROM askeds WHERE askeds.id_game = $idGame) AS ask ON ask.id_question = questions.id 
            LEFT JOIN (SELECT askeds.id_question, COUNT(askeds.id_question) AS frequence FROM askeds GROUP BY askeds.id_question) AS qFrequence ON qFrequence.id_question = questions.id 
            WHERE ask.id_question IS NULL AND questions.state = 0
        "));
//        dd($id[0]->id);

        $hasQ = DB::table("questions")
            ->select("state")
            ->where("state", ">", 0)
            ->get()->count();

        if ($hasQ > 0){
            DB::table('questions')
                ->where('state', -1)
                ->update(['state'=>0]);
            DB::table("questions")
                ->where("id", "=", $id[0]->id)
                ->update(['state'=>-1]);
            return response($id[0]->id ." Question suivante random en attente !", 200)->header('Content-Type', 'text/plain');
        }else{
            DB::table("questions")
                ->where("id", "=", $id[0]->id)
                ->update(['state'=>1,]);
            Asked::registerNewAskedQuestion();
            return response("Question suivante random lancé !", 200)->header('Content-Type', 'text/plain');
        }

    }
    static public function getQuestionResume(){
        return DB::select(DB::raw('
SELECT questions_liste.id, questions_liste.text, questions_liste.image, questions_liste.reponses, qFrequence.frequence, questions.state
FROM questions_liste
LEFT JOIN 
(SELECT askeds.id_question, COUNT(askeds.id_question) AS frequence 
 FROM askeds GROUP BY askeds.id_question) AS qFrequence ON qFrequence.id_question = questions_liste.id
LEFT JOIN questions ON questions.id = questions_liste.id
'));
    }

    static public function getCurrentQuestion($col = null){
        if ($col == null){
//            dd(1);
            return DB::table('questions')
                ->select(['id', 'text', 'image', 'state', 'updated_at'])
                ->where('state', '>', 0)
                ->limit(1)
                ->get();
        }else{
            $answer = DB::table('questions')
                ->select($col)
                ->where('state', '>', 0)
                ->limit(1)
                ->get();
            if($answer->count()>0){
//                dd(3);
                return $answer->first()->$col;
            }else{
//                dd(4);
                return null;
            }

        }

    }
}
