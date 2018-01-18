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

Auth::routes();

Route::prefix('{lang?}')->middleware('locale')->group(function() {
    Route::get('/', 'PageController@home');
    Route::get('/events', 'PageController@events');
    Route::get('/news', 'PageController@news');
    Route::get('/prices', 'PageController@prices');
    Route::get('/contact', 'PageController@contact');
});

Route::get('/redirect/videos/{video}', 'VideoController@open_graph');
