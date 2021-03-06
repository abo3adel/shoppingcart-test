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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/cart', 'CartController@index');
Route::post('/cart/{product}', 'CartController@store');
Route::post('/cart/{id}/patch', 'CartController@update');
Route::post('/cart/{id}/delete', 'CartController@destroy');
