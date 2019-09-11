<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'image'
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
        'text' => 'string',
        'image' => 'string',
    ];

    static public function getQuestions($id=null){
        if($id){
            return DB::table('questions')
                ->select(['id','text','image'])
                ->get();
        }
        else{
            return DB::table('questions')
                ->select(['id','text','image'])
                ->where('id', "=",$id)
                ->get();
        }

    }

    static public function getLastIdQuestion(){
        return DB::table('questions')
            ->select('id')
            ->orderBy('created_at','desc')
            ->get()[0]->id;
    }
}
