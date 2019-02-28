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

Route::prefix('event')->namespace('Quidmye\Http\Controllers')->group(function () {
    Route::get('new', 'EventsController@add')->name('events.add');
    Route::post('add', 'EventsController@add_ajax')->name('events.add.ajax');
    Route::post('new', 'EventsController@add_post')->name('events.add.post');
    Route::get('{id}', 'EventsController@show')->name('event');
    Route::get('edit/{id}', 'EventsController@edit')->name('events.edit');
    Route::post('edit/{id}', 'EventsController@edit_post')->name('events.edit.post');
    Route::get('delete/{id}', 'EventsController@delete')->name('events.delete');
    Route::get('deletefile/{id}', 'EventsController@delete_file')->name('events.deletefile');
});

Route::prefix('events')->namespace('Quidmye\Http\Controllers')->group(function () {
    Route::get('/', 'EventsController@list')->name('events.list');
});
