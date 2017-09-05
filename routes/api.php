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

Route::group(['prefix' => 'all'], function(){
    Route::get('pages', 'PageController@pages')->name('allpages');
});
Route::get('signup', 'UserController@signup')->name('signup');
Route::post('signup', 'UserController@signup')->name('signup');
Route::get('login', 'UserController@login')->name('login');


