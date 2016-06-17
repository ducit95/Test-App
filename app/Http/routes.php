<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', function () {
    return view('index');
});
Route::get('getdata', 'AppController@index');
Route::get('detele/{id}', 'AppController@destroy');
Route::get('getdatauser/{id}', 'AppController@store');
Route::post('update/{id}', 'AppController@update');
Route::post('create', 'AppController@create');
