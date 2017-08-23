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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//User routes
Route::get('users', 'UserController@index')->name('users');
Route::get('user/edit/{user}', 'UserController@edit')->name("user.edit");
Route::get('user/show/{user}', 'UserController@show')->name("user.show");
Route::get('user/create', 'UserController@create')->name("user.create");
Route::post('user/store', 'UserController@store')->name("user.store");
Route::post('user/update/{user}', 'UserController@update')->name("user.update");
Route::get('user/update/{user}', 'UserController@update')->name("user.update");
Route::get('user/delete/{user}', ['as' => 'user.delete', 'uses' => 'UserController@destroy']);

//Pages routes
Route::get('pages', 'PageController@index')->name('pages');
Route::get('page/edit/{page}', 'PageController@edit')->name("page.edit");
Route::get('page/show/{page}', 'PageController@show')->name("page.show");
Route::get('page/create', 'PageController@create')->name("page.create");
Route::post('page/store', 'PageController@store')->name("page.store");
Route::post('page/update/{page}', 'PageController@update')->name("page.update");
Route::get('page/update/{page}', 'PageController@update')->name("page.update");
Route::get('page/delete/{page}', ['as' => 'page.delete', 'uses' => 'PageController@destroy']);

//Login facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebookProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');

//Login twitter
Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderTwitterCallback');

//Login google
Route::get('login/google', 'Auth\LoginController@redirectToGoogleProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderGoogleCallback');