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

Route::get('', 'EventsController@index')->middleware('auth');
Route::group(['middleware' => 'auth'], function() {
    Route::resource('events', 'EventsController');
    Route::post('/send', 'SendController@send')->name('events.send');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/exportAll', 'ExportController@exportAll')->name('events.exportAll');
    Route::get('/exportToday', 'ExportController@exportToday')->name('events.exportToday');
    Route::get('/exportnextFive', 'ExportController@exportnextFive')->name('events.exportnextFive');
    Route::post('/import', 'ExportController@import')->name('events.import');
    
});


Route::group(['middleware' => 'auth'], function() {
    Route::resource('/user', 'UsersController');
});




Auth::routes();


