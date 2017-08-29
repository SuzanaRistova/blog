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
//Route::get('users', 'UserController@index')->name('users')->middleware('role:admin');
//Route::get('user/edit/{user}', 'UserController@edit')->name("user.edit")->middleware('role:admin');
//Route::get('user/show/{user}', 'UserController@show')->name("user.show")->middleware('role:admin');
//Route::get('user/create', 'UserController@create')->name("user.create")->middleware('role:admin');
//Route::post('user/store', 'UserController@store')->name("user.store")->middleware('role:admin');
//Route::post('user/update/{user}', 'UserController@update')->name("user.update")->middleware('role:admin');
//Route::get('user/update/{user}', 'UserController@update')->name("user.update")->middleware('role:admin');
//Route::get('user/delete/{user}', ['as' => 'user.delete', 'uses' => 'UserController@destroy'])->middleware('role:admin');
Route::get('users', 'UserController@index')->name('users')->middleware('role:editor');
Route::get('user/create', 'UserController@create')->name("user.create")->middleware('role:editor');
Route::post('user/store', 'UserController@store')->name("user.store")->middleware('role:editor');
Route::get('user/show/{user}', 'UserController@show')->name("user.show")->middleware('role:editor');

//Page routes
Route::get('pages', 'PageController@index')->name('pages')->middleware('role:admin');
Route::get('page/edit/{page}', 'PageController@edit')->name("page.edit")->middleware('role:admin');
Route::get('page/show/{page}', 'PageController@show')->name("page.show")->middleware('role:admin');
Route::get('page/create', 'PageController@create')->name("page.create")->middleware('role:admin');
Route::post('page/store', 'PageController@store')->name("page.store")->middleware('role:admin');
Route::post('page/update/{page}', 'PageController@update')->name("page.update")->middleware('role:admin');
Route::get('page/update/{page}', 'PageController@update')->name("page.update")->middleware('role:admin');
Route::get('page/delete/{page}', ['as' => 'page.delete', 'uses' => 'PageController@destroy'])->middleware('role:admin');

Route::get('pages', 'PageController@index')->name('pages')->middleware('role:editor');
Route::get('page/edit/{page}', 'PageController@edit')->name("page.edit")->middleware('role:editor');
Route::get('page/show/{page}', 'PageController@show')->name("page.show")->middleware('role:editor');
Route::get('page/create', 'PageController@create')->name("page.create")->middleware('role:editor');
Route::post('page/store', 'PageController@store')->name("page.store")->middleware('role:editor');
Route::post('page/update/{page}', 'PageController@update')->name("page.update")->middleware('role:editor');
Route::get('page/update/{page}', 'PageController@update')->name("page.update")->middleware('role:editor');
Route::get('page/delete/{page}', ['as' => 'page.delete', 'uses' => 'PageController@destroy'])->middleware('role:editor');

Route::get('pages', 'PageController@index')->name('pages')->middleware('role:author');
Route::get('page/edit/{page}', 'PageController@edit')->name("page.edit")->middleware('role:author');
Route::get('page/show/{page}', 'PageController@show')->name("page.show")->middleware('role:author');
Route::get('page/create', 'PageController@create')->name("page.create")->middleware('role:author');
Route::post('page/store', 'PageController@store')->name("page.store")->middleware('role:author');
Route::post('page/update/{page}', 'PageController@update')->name("page.update")->middleware('role:author');
Route::get('page/update/{page}', 'PageController@update')->name("page.update")->middleware('role:author');
Route::get('page/delete/{page}', ['as' => 'page.delete', 'uses' => 'PageController@destroy'])->middleware('role:author');


//Module routes
//Route::get('modules', 'ModuleController@index')->name('modules')->middleware('role:admin');
Route::get('modules', 'ModuleController@index')->name('modules')->middleware('role:subscriber');
Route::get('module/edit/{module}', 'ModuleController@edit')->name("module.edit")->middleware('role:admin');
Route::get('module/show/{module}', 'ModuleController@show')->name("module.show");
Route::get('module/create', 'ModuleController@create')->name("module.create")->middleware('role:admin');
Route::post('module/store', 'ModuleController@store')->name("module.store")->middleware('role:admin');
Route::post('module/update/{module}', 'ModuleController@update')->name("module.update")->middleware('role:admin');
Route::get('module/update/{module}', 'ModuleController@update')->name("module.update")->middleware('role:admin');
Route::get('module/delete/{module}', ['as' => 'module.delete', 'uses' => 'ModuleController@destroy'])->middleware('role:admin');

//Lesson routes
Route::get('lessons', 'LessonController@index')->name('lessons')->middleware('role:admin');
Route::get('lesson/edit/{lesson}', 'LessonController@edit')->name("lesson.edit")->middleware('role:admin');
Route::get('lesson/show/{lesson}', 'LessonController@show')->name("lesson.show");
Route::get('module/{lesson}/lesson/create', 'LessonController@create')->name("lesson.create")->middleware('role:admin');
//Route::get('lesson/create', 'LessonController@create')->name("lesson.create");
Route::post('lesson/store', 'LessonController@store')->name("lesson.store")->middleware('role:admin');
Route::post('lesson/save/{lesson}', 'LessonController@save')->name("lesson.save")->middleware('role:admin');
Route::post('lesson/update/{lesson}', 'LessonController@update')->name("lesson.update")->middleware('role:admin');
Route::get('lesson/update/{lesson}', 'LessonController@update')->name("lesson.update")->middleware('role:admin');
Route::get('lesson/delete/{lesson}', ['as' => 'lesson.delete', 'uses' => 'LessonController@destroy'])->middleware('role:admin');

//Session routes
Route::get('sessions', 'SessionController@index')->name('sessions')->middleware('role:admin');
Route::get('session/edit/{session}', 'SessionController@edit')->name("session.edit")->middleware('role:admin');
Route::get('session/show/{session}', 'SessionController@show')->name("session.show")->middleware('role:admin');
Route::get('session/view/{session}', 'SessionController@view')->name("session.view");
Route::post('session/view/{session}', 'SessionController@view')->name("session.view");
Route::get('lesson/{session}/session/create', 'SessionController@create')->name("session.create")->middleware('role:admin');
Route::post('session/store', 'SessionController@store')->name("session.store")->middleware('role:admin');
Route::post('session/save', 'SessionController@save')->name("session.save");
Route::post('session/update/{session}', 'SessionController@update')->name("session.update")->middleware('role:admin');
Route::get('session/update/{session}', 'SessionController@update')->name("session.update")->middleware('role:admin');
Route::get('session/delete/{session}', ['as' => 'session.delete', 'uses' => 'SessionController@destroy'])->middleware('role:admin');

//Login facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebookProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');

//Login twitter
Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderTwitterCallback');

//Login google
Route::get('login/google', 'Auth\LoginController@redirectToGoogleProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderGoogleCallback');

Auth::routes();