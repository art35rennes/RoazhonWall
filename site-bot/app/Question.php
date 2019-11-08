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

    static public function getQuestionResume(){
        return DB::select(DB::raw('SELECT questions.text, questions.id, COUNT(askeds.id_question) AS recurrence FROM askeds LEFT JOIN questions ON questions.id = askeds.id_question GROUP BY askeds.id_question ORDER BY recurrence ASC'));
    }
}
