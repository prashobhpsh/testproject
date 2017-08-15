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

$domain = env('DOMAIN');
Route::group(['domain' => $domain], function () {
	Route::get('/', function () { return view('welcome');});
	Route::group(['prefix' => 'ng'], function () {
		Route::post('/save-data', 'testController@saveData');
	});
	Route::get('/{slug}', 'TestController@redirectfn');
});
