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

Route::get('/locations', 'LocationController@index');
Route::post('/locations', 'LocationController@store');
Route::delete('/locations/{location}', 'LocationController@destroy');

Route::get('/items', 'ItemController@index');
Route::post('/items', 'ItemController@store');
Route::delete('/items/{item}', 'ItemController@destroy');
