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

    Route::get('pages', 'PageController@index')->name('pages');
    Route::get('page/edit/{page}', 'PageController@edit')->name("page.edit");
    Route::get('page/show/{slug}', 'PageController@show')->name("page.show");
    Route::get('page/create', 'PageController@create')->name("page.create");
    Route::post('page/store', 'PageController@store')->name("page.store");
    Route::post('page/update/{page}', 'PageController@update')->name("page.update");
    Route::get('page/update/{page}', 'PageController@update')->name("page.update");
    Route::get('page/delete/{page}', ['as' => 'page.delete', 'uses' => 'PageController@destroy']);


