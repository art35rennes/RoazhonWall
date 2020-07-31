<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_player', 'id_game', 'value'
    ];

    static function calculateScore(){

        $idGame = Game::getCurrentGame()->id;
        $logs =  DB::select(DB::raw('select * from `logs` left join `playeds` on playeds.id_player = logs.id_player where logs.id_game = '.$idGame.' and playeds.id_game = '.$idGame));

        $rep = Answer::getAnswersFor(Question::getCurrentQuestion("id"));
        $rep = $rep[0]->text;
        $rep = strtolower($rep);
        $rep = str_replace(" ", "_", $rep);

        $stats = ["good"=>0, "wrong"=>0, "challenger"=>null];
        foreach ($logs as $log){
            if ($log->value == $rep){
                $log->type=="challenger"?$stats["challenger"]="good":$stats["good"]++;
            }else{
                $log->type=="challenger"?$stats["challenger"]="wrong":$stats["wrong"]++;
            }
            if ($log->type == "joueur"){
                if ($log->value != $rep){
                    DB::table("playeds")
                        ->where("id_player", "=", $log->id_player)
                        ->where('id_game', "=", $idGame)
                        ->update(["type"=>"out", "updated_at"=>Carbon::now()]);
                }
            }
        }
        if ($stats["challenger"] == "good"){
            DB::table("playeds")
                ->where("type", "=", "challenger")
                ->where('id_game', "=", $idGame)
                ->increment("score", 5*$stats["wrong"]);
        }else{
            DB::table("playeds")
                ->where("type", "=", "challenger")
                ->where('id_game', "=", $idGame)
                ->update(["type"=>"out", "updated_at"=>Carbon::now()]);
        }

    }
    static function getLastTimeAnswer($playerName){
        $id = Player::playerExist($playerName);
        if ($id != false){
            if (Played::isPlaying($playerName)){
                $time = DB::table("logs")
                    ->select('updated_at')
                    ->where('id_player', "=", $id)
                    ->where('id_game', "=", Game::getCurrentGame()->id)
                    ->orderByDesc("updated_at")
                    ->get();
                if ($time->first()==null){
                    return false;
                }else{
                    return $time->first()->updated_at;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
