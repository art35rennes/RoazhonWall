<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Asked extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_game', 'id_player'
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
        'id_game' => 'integer',
        'id_player' => 'integer',
    ];

    static public function registerNewAskedQuestion(){
        $entry = new Asked();
        $entry->id_game = Game::getCurrentGame()->id;
        $entry->id_question = Question::getCurrentQuestion()->first()->id;
        $entry->save();
    }
}
