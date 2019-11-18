<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getStat(){
        $nbQuest = DB::table('questions')->count('id');
        $nbGame = DB::table('games')->count('id');
        $nbJoueurs = DB::table('players')->count('id');
        $leaderBord = DB::select(DB::raw("SELECT players.pseudo, SUM(playeds.score) AS score 
FROM playeds LEFT JOIN players ON players.id = playeds.id_player 
GROUP BY playeds.id_player  
ORDER BY `score` DESC LIMIT 15"));

        $qListe = DB::table('questions_liste')->select(['reponses', 'image'])->get();
        $cpt = [
          "image" => 0,
          "qcm" => 0,
          "simple" => 0
        ];
        foreach ($qListe as $item) {
            if ($item->reponses == 1){
                if ($item->image){
                    $cpt['simple']++;
                }else{
                    $cpt['image']++;
                }
            }else{
                $cpt['qcm']++;
            }
        }
//        dd([
//            "nbQuest" => $nbQuest,
//            "nbGame" => $nbGame,
//            "nbJoueurs" => $nbJoueurs,
//            "leaderBoard" => $leaderBord,
//            "cpt" => $cpt
//        ]);
        return [
            "nbQuest" => $nbQuest,
            "nbGame" => $nbGame,
            "nbJoueurs" => $nbJoueurs,
            "leaderBoard" => $leaderBord,
            "cpt" => $cpt,
            "cGame" => Game::getCurrentGame(),
        ];
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ["stats"=>$this->getStat()]);
    }
}
