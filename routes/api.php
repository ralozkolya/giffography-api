<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('events/{id}/videos', 'EventController@videos');
Route::get('videos/last', 'VideoController@last');
Route::resource('events', 'EventController');
Route::resource('videos', 'VideoController');
Route::resource('files', 'FileController');
