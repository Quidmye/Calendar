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
      $url = 'https://fcm.googleapis.com/fcm/send';
$YOUR_API_KEY = 'AAAAwPQ7cNU:APA91bFac0N-eq4kdAsCpU9Gb7QECDmJjKEp2WbtRMyEhn6vlUxXijDsfzU7dwI_udKnlmaKsdKtzFoMIlWLDCKoJ_eLe9hof58MfPBTi4UydGgU9ugn_r1x15_jlJU9l0PS4uhdhi_E'; // Server key
$YOUR_TOKEN_ID = 'fgpC6ltN8gc:APA91bEaBlEFsy7-JUHjwyNzNgG2oMi9g6eM7SJGdUB7ZvNuykHrpU1Uc30Ow5Fy0PCL8PLc4n1SBSmJZiq-e1a9daLn8usN3B4NZoQqcGHOyyuFHlSRlhMg2_uVqe5qSt_kM6z9UNPA'; // Client token id

$request_body = [
    'to' => $YOUR_TOKEN_ID,
    'notification' => [
        'title' => 'Ералаш',
        'body' => sprintf('Начало в %s.', date('H:i')),
        'icon' => 'https://eralash.ru.rsz.io/sites/all/themes/eralash_v5/logo.png?width=192&height=192',
        'click_action' => 'http://eralash.ru/',
    ],
];
$fields = json_encode($request_body);

$request_headers = [
    'Content-Type: application/json',
    'Authorization: key=' . $YOUR_API_KEY,
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
curl_close($ch);
      Notification::route('gcm', 'fgpC6ltN8gc:APA91bEaBlEFsy7-JUHjwyNzNgG2oMi9g6eM7SJGdUB7ZvNuykHrpU1Uc30Ow5Fy0PCL8PLc4n1SBSmJZiq-e1a9daLn8usN3B4NZoQqcGHOyyuFHlSRlhMg2_uVqe5qSt_kM6z9UNPA')->notify(new EventNotification());
    });
});
