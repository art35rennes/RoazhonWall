<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_question', 'text', 'image', 'true',
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
        'id_question' => 'int',
        'text' => 'string',
        'image' => 'string',
        'true' => 'bool',
    ];

    static public function getAnswersFor($id){
        return DB::table('answers')
            ->select(['text', 'image', 'true'])
            ->where('id_question', "=", $id)
            ->get();
    }
}
