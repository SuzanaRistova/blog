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
    Route::get('pages', 'PageApiController@index');
    Route::get('pages/show/{page}', 'PageApiController@show');
    Route::post('pages/store', 'PageApiController@store');
    Route::put('pages/edit/{page}', 'PageApiController@update');
    Route::delete('pages/delete/{page}', 'PageApiController@destroy');
});