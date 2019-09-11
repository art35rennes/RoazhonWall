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

Route::group(['middleware' => ['auth']], function() {
    Route::get('/table/{table}', "TableController@show");

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/question/add', function () {return view("game.add_question");});
    Route::post('/question/add', 'QuestionController@add');
    Route::get('/question/view/{id}', 'QuestionController@show');

    Route::get('/cgu', function () {return view('cgu');});
});

Auth::routes();

Route::get('/', function () {
    return redirect('/home');
//    return view('welcome');
});
