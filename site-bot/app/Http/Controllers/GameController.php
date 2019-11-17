<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Game;
use App\Question;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GameController extends BaseController
{
    public function start(){
        return view("game.start", ["current"=>Game::gameIsInProgress()]);
    }

    public function play(){
        return view("game.current", (([
            "current"=>Game::getCurrentGame(),
            "players"=>Game::getPlayerListe(),
            "questions"=>Question::getQuestionResume(),
            "cQuestion"=>Question::getCurrentQuestion(),
            "answer"=>Answer::getAnswersFor(Question::getCurrentQuestion('id'))
        ])));
    }
}
