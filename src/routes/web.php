<?php
use Quidmy\Notifications\EventNotification;
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
Route::post('/savetoken', 'Quidmye\Http\Controllers\TokenController@save')->name('token.save');

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
    Route::get('/ee', function(){
      Notification::route('Gcm', 'fgpC6ltN8gc:APA91bEaBlEFsy7-JUHjwyNzNgG2oMi9g6eM7SJGdUB7ZvNuykHrpU1Uc30Ow5Fy0PCL8PLc4n1SBSmJZiq-e1a9daLn8usN3B4NZoQqcGHOyyuFHlSRlhMg2_uVqe5qSt_kM6z9UNPA')->notify(new EventNotification());
    });
});
