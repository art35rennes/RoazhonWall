<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Game;
use App\Log;
use App\Played;
use App\Player;
use App\Question;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class Ressource extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get($filename){
        $path = storage_path('app/' . $filename);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function botInit(){
        $param = DB::table('parametres')->get();
        return json_encode($param);
    }

    public function botGame(){
        $game = Game::getCurrentGame();
        return json_encode($game);
    }

    public function botQuestion(){
        $question = Question::getCurrentQuestion()->first();
        return json_encode($question);
    }

    public function botAnswer(){
        $answer = Answer::getAnswersFor(Question::getCurrentQuestion()->first()->id);
        return json_encode($answer);
    }

    public function botPlayer($name){

        $exist = DB::table("players")->where("pseudo","=",$name)->get();

//        dd($exist->count());
        if(!$exist->count()){
            $player = new Player();
            $player->pseudo = $name;
            $player->save();

            $id = $player->id;
        }else{
            $id = $exist->first()->id;
        }

        $exist = DB::table("playeds")
            ->where('id_player', "=", $id)
            ->where('id_game', "=", Game::getCurrentGame()->id)
            ->count();

        if (!$exist){
            $nbPlayer = DB::table('playeds')
                ->where("id_game", "=", Game::getCurrentGame()->id)
                ->count();

            if ($nbPlayer < Game::getCurrentGame()->size || Game::getCurrentGame()->size == -1){
                $played = new Played();
                $played->id_game = Game::getCurrentGame()->id;
                $played->id_player = $id;
                $played->score = 0;
                $played->save();

                return json_encode("success");
            }else{
                return json_encode("full");
            }
        }else{
            return json_encode("already_in");
        }
    }

    public function botPlayerAnswer($name, $answer)
    {
        $question = Question::getCurrentQuestion()[0];
//        dd($rep, $name, $answer, $question);
        if ($question->state == 1) {
            if (Played::isPlaying($name)) {
                if (!Played::isOut($name)){
                    $rep = Answer::getAnswersFor(Question::getCurrentQuestion("id"));
                    $rep = $rep[0]->text;
                    $rep = strtolower($rep);
                    $rep = str_replace(" ", "_", $rep);

                    $time = Log::getLastTimeAnswer($name);
//                    dd("a",$time,"q", $question->updated_at);
                    if ($time < $question->updated_at){
                        $log = new Log();
                        $log->id_player = Player::getPlayerId($name);
                        $log->id_game = Game::getCurrentGame()->id;
                        $log->value = $answer;
                        $log->save();

                        if ($rep == $answer){
                            return json_encode("good");
                        }else{
                            return json_encode("wrong");
                        }
                    }else{
                        return json_encode("already_answer");
                    }
                }else{
                    return json_encode('out');
                }
            } else {
                return json_encode('dont_play');
            }
        }


    }
}
