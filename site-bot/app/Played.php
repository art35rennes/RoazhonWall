<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Played extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_game', 'id_player', 'score',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_game' => "integer",
        'id_player' => "integer",
        'score' => "integer",
    ];

    static function isPlaying($playerName){
        $id = Player::playerExist($playerName);
        if ($id != false){
            $exist = DB::table("playeds")
                ->where('id_player', "=", $id)
                ->where('id_game', "=", Game::getCurrentGame()->id)
                ->count();
            if ($exist == 1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    static function isOut($playerName){
        $id = Player::playerExist($playerName);
        if ($id != false){
            $exist = DB::table("playeds")
                ->where('id_player', "=", $id)
                ->where('id_game', "=", Game::getCurrentGame()->id)
                ->get();
            if ($exist->first->type == "out"){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
}
