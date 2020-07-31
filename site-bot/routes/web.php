<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Log;
use App\Question;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function() {
    Route::get('/table/{table}', "TableController@show");

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/question/add', function () {return view("game.add_question");});
    Route::get('/game/start', 'GameController@start');
    Route::post('/game/new', 'GameController@new');
    Route::get('/game/current', 'GameController@play');
    Route::get('/game/end', 'GameController@end');

    Route::get('/game/state/{state}/{id}', 'QuestionController@stateChange');
    Route::get('/game/player/{state}/{id}', 'PlayerController@stateChange');
    Route::get('/game/player/random', 'PlayerController@setRandomChallenger');
    Route::get('/game/question/reply', 'QuestionController@giveAnswer');
    Route::get('/game/question/next', 'QuestionController@nextQuestion');
    //TODO Route::get('/game/question/dismiss', 'QuestionController@nextQuestion');
    Route::get('/game/question/random', function (){return Question::setRandomQuestion();});

    Route::post('/question/add', 'QuestionController@add');
    Route::get('/question/view/{id?}', 'QuestionController@view');

    Route::get('/cgu', function () {return view('cgu');});
});

Auth::routes();

Route::group(['middleware' => ['localhost']], function() {
    Route::get('/bot/init', 'Ressource@botInit');
    Route::get('/bot/game', 'Ressource@botGame');
    Route::get('/bot/question', 'Ressource@botQuestion');
    Route::get('/bot/answer', 'Ressource@botAnswer');
    Route::get('/bot/player/{name}', 'Ressource@BotPlayer');
    Route::get('/bot/answer/{name}/{answer}', 'Ressource@BotPlayerAnswer');
    Route::get('/bot/score', function (){return Log::calculateScore();});
});

Route::get('/', function () {
    return redirect('/home');
//    return view('welcome');
});
