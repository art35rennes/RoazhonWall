<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Game;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class GameController extends BaseController
{
    public function start(){
        return view("game.start", ["current"=>Game::gameIsInProgress()]);
    }
    public function end(){
        $Game = Game::getCurrentGame();
        DB::table('games')
            ->where('id', $Game->id)
            ->update(['end_at'=>Carbon::now()->toDateTimeString()]);
        DB::table("questions")
            ->where("id", "!=", 0)
            ->update(["state"=>0]);
        return Redirect::to("/");
    }
    public function new(Request $request){
//        dd($request);
//        dd($request->input());
        $game = new Game();
        $game->nom = $request->input("name");
        $game->size = $request->input('gamer', -1);
        $game->save();
//        dd($game);
        return Redirect::to("/game/current");

    }
    public function play(){
        if (Game::gameIsInProgress()){
            return view("game.current", (([
                "current"=>Game::getCurrentGame(),
                "players"=>Game::getPlayerListe(),
                "questions"=>Question::getQuestionResume(),
                "cQuestion"=>Question::getCurrentQuestion(),
                "answer"=>Answer::getAnswersFor(Question::getCurrentQuestion('id'))
            ])));
        }
        else{
            return $this->start();
        }

    }
}
