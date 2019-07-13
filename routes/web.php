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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/privacy', 'TermsAndPrivacyController@privacy')->name('privacy');
Route::get('/tos', 'TermsAndPrivacyController@tos')->name('tos');

Route::get('login/{provider}', 'SocialiteController@redirectToProvider');
Route::get('login/{provider}/callback', 'SocialiteController@handleProviderCallback');

Route::group(['middleware' => ['auth', 'admin']], function () {
	Route::get('/locations', 'LocationController@index');
	Route::post('/locations', 'LocationController@store');
	Route::delete('/locations/{location}', 'LocationController@destroy');
	Route::get('/locations/{location}', 'LocationController@edit');
	Route::put('/locations/{location}', 'LocationController@update');	

	Route::get('/items', 'ItemController@index');
	Route::post('/items', 'ItemController@store');
	Route::delete('/items/{item}', 'ItemController@destroy');
	Route::get('/items/{item}', 'ItemController@edit');
	Route::put('/items/{item}', 'ItemController@update');
		
	//Route::get('/items/{item}/prices', 'PriceController@export');
	Route::get('/items/{item}/prices/{startDate}/{endDate}', 'PriceController@export');
});

Route::group(['middleware' => ['auth']], function () {
	Route::post('/prices', 'PriceController@store');
	Route::delete('/prices/{price}', 'PriceController@destroy');

	Route::get('/monitor', 'MonitorController@index')->name('monitor');
});