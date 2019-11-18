<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'size'
    ];

    static public function gameIsInProgress(){
        $cGame = DB::table('games')
            ->select(['id', 'nom','end_at'])
            ->where('end_at', "=", null)
            ->get();

        if ($cGame->count()>0){
            return $cGame->first();
        }else{
            return false;
        }
    }

    static public function getCurrentGame(){
        $cGame = DB::table('games')
            ->where('end_at', "=", null)
            ->get();

        if ($cGame->count()>0){
            return $cGame->first();
        }else{
            return false;
        }
    }

    static public function getPlayerListe($gameId = null){
        if ($gameId == null)
            $gameId = self::getCurrentGame()->id;

        return DB::table('playeds')
            ->select(['id_player', 'pseudo', 'score', 'type'])
            ->leftJoin('players','id_player', '=', 'id')
            ->where('id_game', '=', $gameId)
            ->orderBy('pseudo')
            ->get();
    }
}
