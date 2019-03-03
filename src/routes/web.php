<?php
use Quidmye\Notifications\EventNotification;
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

      Notification::route('gcm', 'dfmygZDHXmI:APA91bGjToU3Y4QUZMObXy0gH-kZoMaLvRQx8W1IjfkGzCgJnuNJytV8-JjkeLefIU6pt7aL7gaOdg65tVTaaj7qK03CElDzXBhG6Px-ddS37coFDU1xSPTq3EhNHZq12rw5yLQED8Tb')->notify(new EventNotification());
    });
});
