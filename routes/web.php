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

//Route::get('/', function () {
//    return view('welcome');
//});

use Illuminate\Http\File;
use Illuminate\Http\Response;

Route::get('/import', 'IndexController@import')->name('movies.import');
Route::get('/', 'IndexController@index')->name('movies.index');
Route::get('/{id}', 'IndexController@view')->name('movies.view');
