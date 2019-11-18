<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class PlayerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function stateChange($state, $id){
        $Game = Game::getCurrentGame();
        switch ($state){
            case "upstate":
//                Remove Old Challenger
                DB::table("playeds")
                ->where([
                    ['id_game', $Game->id],
                    ['type', "challenger"]
                ])
                ->update(['type'=>'joueur']);
//                Set New Challenger
                DB::table("playeds")
                ->where([
                    ['id_game', $Game->id],
                    ['id_player', $id]
                ])
                ->update(['type'=>'challenger']);
                return response("Nouveau challenger pris en compte !", 200)->header('Content-Type', 'text/plain');
            case "downstate":
                DB::table("playeds")
                    ->where([
                        ['id_game', $Game->id],
                        ['id_player', $id]
                    ])
                    ->update(['type'=>'joueur']);
                return response("Challenger remove !", 200)->header('Content-Type', 'text/plain');
            case "ban":
                DB::table("playeds")
                    ->where([
                        ['id_game', $Game->id],
                        ['id_player', $id]
                    ])
                    ->delete();
                return response("Player remove !", 200)->header('Content-Type', 'text/plain');
        }
        return response("fail", 501);
    }
}
