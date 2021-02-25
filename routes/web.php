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


Route::get('user','TaskController@index')->name('come'); 

Route::get('/','TaskController@create')->name('new'); 

 Route::post('load','TaskController@store')->name('load'); 

Route::get('update/{id}','TaskController@show')->name('show'); 
 Route::post('/updateUser', 'TaskController@update');