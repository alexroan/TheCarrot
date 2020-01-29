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

Route::get('/', 'ClosureController@index');

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile', 'ProfileController@update');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::post('/admin', 'AdminController@create');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact', 'ContactController@send');

// OAuth2 stuff
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

// Selecting lists from mailchimp
Route::get('/mailchimp/lists', 'MailchimpController@lists');
Route::post('/mailchimp/lists', 'MailchimpController@select');

// Creating Carrots
Route::get('/carrot/create', 'CarrotController@index');
Route::post('/carrot/create', 'CarrotController@create');

// Subscribing
Route::get('/subscribe', 'SubscribeController@subscribe');
Route::get('/confirm', 'SubscribeController@confirm');