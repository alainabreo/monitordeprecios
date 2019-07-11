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

Route::get('login/facebook', 'SocialiteController@redirectToProvider')->name('login.facebook');
Route::get('login/facebook/callback', 'SocialiteController@handleProviderCallback');

Route::get('login/twitter', 'SocialiteController@redirectToTwitterProvider')->name('login.twitter');
Route::get('login/twitter/callback', 'SocialiteController@handleTwitterProviderCallback');

Route::get('login/google', 'SocialiteController@redirectToGoogleProvider')->name('login.google');
Route::get('login/google/callback', 'SocialiteController@handleGoogleProviderCallback');
