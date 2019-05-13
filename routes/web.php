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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::post('/upload', 'DataController@import')->name('data.upload');
Route::post('/verify/{uuid}', 'DataController@verify')->name('data.verify');
Route::prefix('/attendees')->group(function (){
   Route::post('/add', 'AttendeeController@add');
});

Route::prefix('/api')->group(function (){
   Route::prefix('/attendee')->group(function (){
     Route::post('/verify', 'AttendeeController@verifyAttendee')->name('attendee.verify');
     Route::post('/add', 'AttendeeController@addAttendee')->name('attendee.add');
   });
});

Route::get('/data', function (){return view('data');});
Route::post('/send_qr', 'DataController@sendQr')->name('sendData');
Route::get('/test_email', function (\App\Data $data){
    $data = $data->find(1);
    return new \App\Mail\EventSent($data);
});
Route::get('/php', function (){return dd(phpinfo());});
Route::get('/send_one', function (){
   \Illuminate\Support\Facades\Mail::to('nelson@nelsonatuonwu.me')->send(new \App\Mail\EventSent(\App\Data::all()->first()));
});
