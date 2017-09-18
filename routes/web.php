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
Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update_avatar');
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function(){
    Route::get('session_user', 'SessionController@session_user');
    Route::post('session_user', 'SessionController@update_session_user');
});

Auth::routes();

Route::get('mail', 'HomeController@mail');

//User routes
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin,editor']], function(){
    Route::get('users', 'UserController@index')->name('users')->middleware('role:admin,editor');
    Route::get('user/edit/{user}', 'UserController@edit')->name("user.edit")->middleware('role:admin');
    Route::get('user/show/{user}', 'UserController@show')->name("user.show")->middleware('role:admin,editor');
    Route::get('user/create', 'UserController@create')->name("user.create")->middleware('role:admin,editor');
    Route::post('user/store', 'UserController@store')->name("user.store")->middleware('role:admin,editor');
    Route::post('user/update/{user}', 'UserController@update')->name("user.update")->middleware('role:admin');
    Route::get('user/update/{user}', 'UserController@update')->name("user.update")->middleware('role:admin');
    Route::get('user/delete/{user}', ['as' => 'user.delete', 'uses' => 'UserController@destroy'])->middleware('role:admin');

});

//Page routes
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin,editor,author']], function(){
//    Route::get('pages', 'PageController@index')->name('pages');
    Route::get('page/edit/{page}', 'PageController@edit')->name("page.edit");
//    Route::get('page/show/{slug}', 'PageController@show')->name("page.show");
    Route::get('page/create', 'PageController@create')->name("page.create");
    Route::post('page/store', 'PageController@store')->name("page.store");
    Route::post('page/update/{page}', 'PageController@update')->name("page.update");
    Route::get('page/update/{page}', 'PageController@update')->name("page.update");
    Route::get('page/delete/{page}', ['as' => 'page.delete', 'uses' => 'PageController@destroy']);
});

 Route::get('pages', 'PageController@index')->name('pages');
 Route::get('page/show/{slug}', 'PageController@show')->name("page.show");
 
// Vue js
 Route::post('vue/pages', 'PageApiController@store')->name('vue/pages');
 Route::get('vue/pages', 'PageApiController@index')->name('vue/pages');
 Route::delete('vue/page/delete/{page}', ['as' => 'page.delete', 'uses' => 'PageApiController@destroy']);

//Module routes with prefix admin
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function(){
    Route::get('modules', 'ModuleController@index')->name('modules')->middleware('role:admin');
    Route::get('module/edit/{module}', 'ModuleController@edit')->name("module.edit")->middleware('role:admin');
    Route::get('module/show/{slug}', 'ModuleController@show')->name("module.show")->middleware('role:admin');
    Route::get('module/create', 'ModuleController@create')->name("module.create")->middleware('role:admin');
    Route::post('module/store', 'ModuleController@store')->name("module.store")->middleware('role:admin');
    Route::post('module/update/{module}', 'ModuleController@update')->name("module.update")->middleware('role:admin');
    Route::get('module/update/{module}', 'ModuleController@update')->name("module.update")->middleware('role:admin');
    Route::get('module/delete/{module}', ['as' => 'module.delete', 'uses' => 'ModuleController@destroy'])->middleware('role:admin');
});

//Module routes 
 Route::get('modules', 'ModuleController@index')->name('modules')->middleware('role:admin,subscriber');
 Route::get('module/show/{slug}', 'ModuleController@show')->name("module.show")->middleware('role:admin,subscriber');

//Lesson routes with prefix admin
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function(){
    Route::get('lessons', 'LessonController@index')->name('lessons')->middleware('role:admin');
    Route::get('lesson/edit/{lesson}', 'LessonController@edit')->name("lesson.edit")->middleware('role:admin');
    Route::get('lesson/show/{slug}', 'LessonController@show')->name("lesson.show")->middleware('role:admin');
    Route::get('module/{lesson}/lesson/create', 'LessonController@create')->name("lesson.create")->middleware('role:admin');
    Route::post('lesson/store', 'LessonController@store')->name("lesson.store")->middleware('role:admin');
    Route::post('lesson/save/{lesson}', 'LessonController@save')->name("lesson.save")->middleware('role:admin');
    Route::post('lesson/update/{lesson}', 'LessonController@update')->name("lesson.update")->middleware('role:admin');
    Route::get('lesson/update/{lesson}', 'LessonController@update')->name("lesson.update")->middleware('role:admin');
    Route::get('lesson/delete/{lesson}', ['as' => 'lesson.delete', 'uses' => 'LessonController@destroy'])->middleware('role:admin');
});

//Lesson routes
Route::get('lesson/show/{slug}', 'LessonController@show')->name("lesson.show")->middleware('role:admin,subscriber');

//Session routes with prefix admin
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function(){
    Route::get('sessions', 'SessionController@index')->name('sessions')->middleware('role:admin');
    Route::get('session/edit/{session}', 'SessionController@edit')->name("session.edit")->middleware('role:admin');
    Route::get('session/show/{slug}', 'SessionController@show')->name("session.show")->middleware('role:admin');
    Route::get('session/view/{slug}', 'SessionController@view')->name("session.view")->middleware('role:admin');
    Route::post('session/view/{slug}', 'SessionController@view')->name("session.view")->middleware('role:admin');
    Route::get('lesson/{session}/session/create', 'SessionController@create')->name("session.create")->middleware('role:admin');
    Route::post('session/store', 'SessionController@store')->name("session.store")->middleware('role:admin');
    Route::post('session/save', 'SessionController@save')->name("session.save")->middleware('role:admin');
    Route::post('session/update/{session}', 'SessionController@update')->name("session.update")->middleware('role:admin');
    Route::get('session/update/{session}', 'SessionController@update')->name("session.update")->middleware('role:admin');
    Route::get('session/delete/{session}', ['as' => 'session.delete', 'uses' => 'SessionController@destroy'])->middleware('role:admin');
});

//Session routes
Route::get('session/view/{slug}', 'SessionController@view')->name("session.view")->middleware('role:admin,subscriber');
Route::post('session/view/{slug}', 'SessionController@view')->name("session.view")->middleware('role:admin,subscriber');
Route::post('session/save', 'SessionController@save')->name("session.save")->middleware('role:admin,subscriber');

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