<?php

/*
|--------------------------------------------------------------------------
| EFSilllication Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an EFSilllication.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'SupplyController@showList');

Route::get('/supplies/{width?}', 'SupplyController@showList');
Route::get('/supply/', 'SupplyController@add');
Route::post('/supply/', 'SupplyController@update');
Route::get('/supply/{id}', 'SupplyController@edit');
Route::delete('/supply/{id}', 'SupplyController@delete');
Route::get('/export/supplies', 'SupplyController@export');

Route::get('/orders/', 'OrderController@showList');
Route::get('/order/{id}', 'OrderController@showProducts');
Route::delete('/order/{id}', 'OrderController@delete');
Route::post('/import/order', 'OrderController@import');

Route::get('/task/', 'TaskController@next');
Route::post('/task/complete/', 'TaskController@complete');
Route::get('/history/', 'TaskController@history');
