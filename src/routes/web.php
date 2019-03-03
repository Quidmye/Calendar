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

      Notification::route('gcm', 'emAUR9mCjOA:APA91bH3zIcyIRPHousFFp8r2g41uebaHIunzWAECoByrLcppJj14updw0Mjkp9vEKLJH6fLu88H_aqJKLb_CW0zxFDxvf1YMWm1vylNK7gLbmbrmIdXzq-2CltFZ0KC4m68oIsreYM8')->notify(new EventNotification());
    });
});
