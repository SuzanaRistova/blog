<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::guard('api')->user(); // instance of the logged user
Auth::guard('api')->check(); // if a user is authenticated
Auth::guard('api')->id();

//Route::group(['prefix' => 'all'], function(){
//    Route::get('pages', 'PageController@pages')->name('allpages');
//});
//Route::get('signup', 'UserController@signup')->name('signup');
//Route::post('signup', 'UserController@signup')->name('signup');
//Route::get('login', 'UserController@login')->name('login');

Route::post('register', 'Auth\RegisterController@register');
Route::get('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

    
Route::group(['prefix' => 'all'], function(){
//    Pages
    Route::get('pages', 'PageApiController@index');
    Route::get('pages/show/{page}', 'PageApiController@show');
    Route::post('pages/store', 'PageApiController@store');
    Route::put('pages/edit/{page}', 'PageApiController@update');
    Route::delete('pages/delete/{page}', 'PageApiController@destroy');
    
//    Modules
    Route::get('modules', 'ModuleApiController@index');
    Route::get('modules/show/{module}', 'ModuleApiController@show');
    Route::post('modules/store', 'ModuleApiController@store');
    Route::put('modules/edit/{module}', 'ModuleApiController@update');
    Route::delete('modules/delete/{module}', 'ModuleApiController@destroy');
    
//    Lesson
    Route::get('lessons', 'LessonApiController@index');
    Route::get('lessons/show/{lesson}', 'LessonApiController@show');
    Route::post('lessons/store', 'LessonApiController@store');
    Route::put('lessons/edit/{lesson}', 'LessonApiController@update');
    Route::delete('lessons/delete/{lesson}', 'LessonApiController@destroy');
    
//     Session
    Route::get('sessions', 'SessionApiController@index');
    Route::get('sessions/show/{session}', 'SessionApiController@show');
    Route::post('sessions/store', 'SessionApiController@store');
    Route::put('sessions/edit/{session}', 'SessionApiController@update');
    Route::delete('sessions/delete/{session}', 'SessionApiController@destroy');
});