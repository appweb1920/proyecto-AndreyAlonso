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

//Route::get('/', function () {
//    return view('welcome');
//});



Auth::routes();

Route::get('/', 'PublicationController@show');
Route::get('/home', 'PublicationController@show');//->name('home');
Route::get('/publications', 'PublicationController@show');
Route::get('/publication/{id}', 'PublicationController@showByID');
Route::post('/addPublication', 'PublicationController@create');

Route::get('/createResponse/{id}', 'ResponseController@edit');
Route::post('/addResponse', 'ResponseController@create');

Route::get('/deleteResponse/{id}', 'ResponseController@delete');
Route::get('/addLike/{id}', 'ResponseController@addLike');
Route::get('/removeLike/{id}', 'ResponseController@removeLike');
Route::get('/addApprove/{id}', 'ResponseController@addApprove');
Route::get('/removeApprove/{id}', 'ResponseController@removeApprove');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
