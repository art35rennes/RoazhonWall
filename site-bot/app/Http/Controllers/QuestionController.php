<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuestionController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function view($id=null){
        if($id == null){
            return view('game.view_question', [
                'headers'=>['1'=>'Numéro','2'=>'Question','3'=>'Type','5'=>'Modifier le'],
//            'headers'=>['1'=>'Id','2'=>'Question','3'=>'Réponse','4'=>'Image','5'=>'Modifier le'],
                "datas" => Question::getQuestionsListe(),
                "id" => null
            ]);
        }else{
//            dd(Question::getQuestions($id));
            $r = Question::getQuestions($id);
            if (count($r["answer"]) > 1){
                $type = "QCM";
            }else{
                if (count($r["answer"]) == 0){
                    $type = "Non définie";
                }else{
                    if ($r["answer"][0]->image != ""){
                        $type = "Image Mystère";
                    }else{
                        $type = "Question simple";
                    }
                }

            }
            return view('game.view_question', [
                "datas" => $r,
                "type"=> $type,
                "id" => $id
            ]);
        }

    }

    public function add(Request $request){

        $question = new Question();
        $question->text = $request->question;
        $answers = [];

        switch ($request->typeQuestion){
            case "q":
                array_push($answers, new Answer());
                $answers[0]->text = $request->ouverte;
                break;
            case "m":
                for ($i=1; $i<=6; $i++){
                    if ($request->get("reponse".$i) != null){
                        array_push($answers, new Answer());
                        last($answers)->text = $request->get("reponse".$i);
                        if ($i != $request->reponseRadio){
                            last($answers)->true = false;
                        }
                    }
                }
                break;
            case "i":
                $path1 = $request->file('imageQ')->store('images/questions',"public");
                $question->image = $path1;
                $path2 = $request->file('imageA')->store('images/reponses',"public");
                array_push($answers, new Answer());
                last($answers)->image = $path2;
                break;
        }
        $question->save();
        foreach ($answers as $answer){
            $answer->id_question = Question::getLastIdQuestion();
            $answer->save();
        }
//        dd($request);

        return view('game.add_question')->withInput($request->input());

    }
}
