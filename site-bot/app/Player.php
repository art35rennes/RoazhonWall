<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Player extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudo',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'pseudo' => 'string',
    ];

    static function getPlayerId($playerName){
        return self::playerExist($playerName)?DB::table("players")->where("pseudo","=",$playerName)->get()->first()->id:null;
    }
    static function playerExist($playerName){
        $exist = DB::table("players")->where("pseudo","=",$playerName)->get();
        if ($exist->count() == 1){
            return $exist->first()->id;
        }else{
            return false;
        }
    }
}
