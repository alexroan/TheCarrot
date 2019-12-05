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

// OAuth2 stuff
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

// Selecting lists from mailchimp
Route::get('/mailchimp/lists', 'MailchimpController@lists');
Route::post('/mailchimp/lists', 'MailchimpController@select');

// Creating Carrots
Route::get('/carrot/create', 'CarrotController@index');
Route::post('/carrot/create', 'CarrotController@create');