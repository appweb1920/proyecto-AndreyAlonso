<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|
| Se considera el campo user_type como 1 para administrador y 0 que es default para usuario general
*/



Auth::routes();

Route::get('/', 'PublicationController@show');

// Rutas para las publicaciones
Route::get('/home', 'PublicationController@show');
Route::get('/publications', 'PublicationController@show');
Route::get('/publication/{id}', 'PublicationController@showByID');
Route::post('/addPublication', 'PublicationController@create');
Route::get('/addLikePublication/{id}', 'PublicationController@addLike');
Route::get('/removeLikePublication/{id}', 'PublicationController@removeLike');
Route::get('/deletePublication/{id}', 'PublicationController@delete');

// Rutas para las respuestas
Route::get('/createResponse/{id}', 'ResponseController@edit');
Route::get('/editResponse/{id}', 'ResponseController@editWithID');
Route::post('/addResponse', 'ResponseController@create');
Route::post('/updateResponse', 'ResponseController@update');
Route::get('/deleteResponse/{id}', 'ResponseController@delete');
Route::get('/addLike/{id}', 'ResponseController@addLike');
Route::get('/removeLike/{id}', 'ResponseController@removeLike');
Route::get('/addApprove/{id}', 'ResponseController@addApprove');
Route::get('/removeApprove/{id}', 'ResponseController@removeApprove');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
