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

//Page routes
Route::get('pages', 'PageController@index')->name('pages');
Route::get('page/edit/{page}', 'PageController@edit')->name("page.edit");
Route::get('page/show/{page}', 'PageController@show')->name("page.show");
Route::get('page/create', 'PageController@create')->name("page.create");
Route::post('page/store', 'PageController@store')->name("page.store");
Route::post('page/update/{page}', 'PageController@update')->name("page.update");
Route::get('page/update/{page}', 'PageController@update')->name("page.update");
Route::get('page/delete/{page}', ['as' => 'page.delete', 'uses' => 'PageController@destroy']);

//Module routes
Route::get('modules', 'ModuleController@index')->name('modules');
Route::get('module/edit/{module}', 'ModuleController@edit')->name("module.edit");
Route::get('module/show/{module}', 'ModuleController@show')->name("module.show");
Route::get('module/create', 'ModuleController@create')->name("module.create");
Route::post('module/store', 'ModuleController@store')->name("module.store");
Route::post('module/update/{module}', 'ModuleController@update')->name("module.update");
Route::get('module/update/{module}', 'ModuleController@update')->name("module.update");
Route::get('module/delete/{module}', ['as' => 'module.delete', 'uses' => 'ModuleController@destroy']);

//Lesson routes
Route::get('lessons', 'LessonController@index')->name('lessons');
Route::get('lesson/edit/{lesson}', 'LessonController@edit')->name("lesson.edit");
Route::get('lesson/show/{lesson}', 'LessonController@show')->name("lesson.show");
Route::get('module/{lesson}/lesson/create', 'LessonController@create')->name("lesson.create");
//Route::get('lesson/create', 'LessonController@create')->name("lesson.create");
Route::post('lesson/store', 'LessonController@store')->name("lesson.store");
Route::post('lesson/save/{lesson}', 'LessonController@save')->name("lesson.save");
Route::post('lesson/update/{lesson}', 'LessonController@update')->name("lesson.update");
Route::get('lesson/update/{lesson}', 'LessonController@update')->name("lesson.update");
Route::get('lesson/delete/{lesson}', ['as' => 'lesson.delete', 'uses' => 'LessonController@destroy']);

//Session routes
Route::get('sessions', 'SessionController@index')->name('sessions');
Route::get('session/edit/{session}', 'SessionController@edit')->name("session.edit");
Route::get('session/show/{session}', 'SessionController@show')->name("session.show");
Route::get('session/view/{session}', 'SessionController@view')->name("session.view");
Route::post('session/view/{session}', 'SessionController@view')->name("session.view");
Route::get('lesson/{session}/session/create', 'SessionController@create')->name("session.create");
Route::post('session/store', 'SessionController@store')->name("session.store");
Route::post('session/save/{session}', 'SessionController@save')->name("session.save");
Route::post('session/update/{session}', 'SessionController@update')->name("session.update");
Route::get('session/update/{session}', 'SessionController@update')->name("session.update");
Route::get('session/delete/{session}', ['as' => 'session.delete', 'uses' => 'SessionController@destroy']);

//Login facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebookProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');

//Login twitter
Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderTwitterCallback');

//Login google
Route::get('login/google', 'Auth\LoginController@redirectToGoogleProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderGoogleCallback');