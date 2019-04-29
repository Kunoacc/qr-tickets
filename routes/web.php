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
Route::post('/upload_data', 'DataController@import')->name('importData');
Route::get('/data', function (){return view('data');});
Route::post('/send_qr', 'DataController@sendQr')->name('sendData');
Route::get('/test_email', function (\App\Data $data){
    $data = $data->find(1);
    return new \App\Mail\EventSent($data);
});
Route::get('/php', function (){return dd(phpinfo());});
Route::get('/migrate', function (){
   \Illuminate\Support\Facades\Artisan::call('migrate');
});
