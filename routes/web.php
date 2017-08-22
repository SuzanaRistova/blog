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
Route::get('users', 'UserController@index')->name('users');
Route::get('user/{user}/edit', 'UserController@edit')->name("user.edit");
Route::get('user/{user}/show', 'UserController@show')->name("user.show");
Route::get('user/create', 'UserController@create')->name("user.create");
Route::post('user/store', 'UserController@store')->name("user.store");
Route::post('user/{user}/update', 'UserController@update')->name("user.update");
Route::get('user/{user}/update', 'UserController@update')->name("user.update");
Route::get('user/{user}/delete', ['as' => 'user.delete', 'uses' => 'UserController@destroy']);