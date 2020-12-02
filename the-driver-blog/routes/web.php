<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/publications', 'PublicationController@show');
Route::get('/publication/{id}', 'PublicationController@showByID');
Route::post('/addPublication', 'PublicationController@create');

Route::get('/createResponse/{id}', 'ResponseController@edit');
Route::post('/addResponse', 'ResponseController@create');
