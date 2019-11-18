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

use App\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function() {
    Route::get('/table/{table}', "TableController@show");

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/question/add', function () {return view("game.add_question");});
    Route::get('/game/start', 'GameController@start');
    Route::post('/game/new', 'GameController@new');
    Route::get('/game/current', 'GameController@play');
    Route::get('/game/end', 'GameController@end');

    Route::post('/game/state/{state}/{id}', 'QuestionController@stateChange');
    Route::post('/game/player/{state}/{id}', 'PlayerController@stateChange');
    Route::post('/game/player/random', 'PlayerController@setRandomChallenger');
    Route::post('/game/question/reply', 'QuestionController@giveAnswer');
    Route::post('/game/question/next', 'QuestionController@nextQuestion');
    Route::post('/game/question/random', function (){return Question::setRandomQuestion();});

    Route::post('/question/add', 'QuestionController@add');
    Route::get('/question/view/{id?}', 'QuestionController@view');

    Route::get('/cgu', function () {return view('cgu');});
});

Auth::routes();

Route::get('/', function () {
    return redirect('/home');
//    return view('welcome');
});
