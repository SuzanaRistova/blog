<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;

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

//Auth::guard('api')->user(); // instance of the logged user
//Auth::guard('api')->check(); // if a user is authenticated
//Auth::guard('api')->id();

//Route::group(['prefix' => 'all'], function(){
//    Route::get('pages', 'PageController@pages')->name('allpages');
//});
//Route::get('signup', 'UserController@signup')->name('signup');
//Route::post('signup', 'UserController@signup')->name('signup');
//Route::get('login', 'UserController@login')->name('login');

//Route::post('register', 'Auth\RegisterController@register');
//Route::get('register', 'Auth\RegisterController@register');
//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => ['api']], function () {
    Route::post('register', 'APIController@register');
    Route::post('login', 'APIController@login');
    Route::post('logout', 'APIController@logout');
    Route::post('details', 'APIController@details');
    Route::group(['middleware' => 'jwt-auth'], function () {
    	Route::post('get_user_details', 'APIController@get_user_details');
    });
});

 Route::get('pages', 'PageApiController@index');
 Route::get('pages/show/{page}', 'PageApiController@show');

  Route::get('/search',function(){
    $query = Input::get('query');
    $users = User::where('name','like','%'.$query.'%')->get();
    return response()->json($users);
});
    
Route::group(['middleware' => 'auth:api'], function(){
//    Users
    Route::get('users', 'UserApiController@index')->middleware('scope:user-read,read');
    Route::get('users/show/{user}', 'UserApiController@show')->middleware('scope:user-read,read');
    Route::post('users/store', 'UserApiController@store')->middleware('scope:user-read,read');;
    Route::put('users/edit/{user}', 'UserApiController@update')->middleware('scope:read');
    Route::delete('users/delete/{user}', 'UserApiController@destroy')->middleware('scope:read');
    Route::get('users/{user}/pages', 'UserApiController@get_pages')->middleware('scope:read');
    Route::get('users/{user}/modules', 'UserApiController@get_modules')->middleware('scope:read');
    
//    Pages
    Route::post('pages/store', 'PageApiController@store');
    Route::put('pages/edit/{page}', 'PageApiController@update');
    Route::delete('pages/delete/{page}', 'PageApiController@destroy');
    
//    Modules
    Route::get('modules', 'ModuleApiController@index');
    Route::get('modules/show/{module}', 'ModuleApiController@show');
    Route::post('modules/store', 'ModuleApiController@store');
    Route::put('modules/edit/{module}', 'ModuleApiController@update');
    Route::delete('modules/delete/{module}', 'ModuleApiController@destroy');
    Route::get('modules/{module}/lessons', 'ModuleApiController@get_lessons');
    
//    Lesson
    Route::get('lessons', 'LessonApiController@index');
    Route::get('lessons/show/{lesson}', 'LessonApiController@show');
    Route::post('lessons/store', 'LessonApiController@store');
    Route::put('lessons/edit/{lesson}', 'LessonApiController@update');
    Route::delete('lessons/delete/{lesson}', 'LessonApiController@destroy');
    Route::get('lessons/{lesson}/sessions', 'LessonApiController@get_sessions');
    
//     Session
    Route::get('sessions', 'SessionApiController@index');
    Route::get('sessions/show/{session}', 'SessionApiController@show');
    Route::post('sessions/store', 'SessionApiController@store');
    Route::put('sessions/edit/{session}', 'SessionApiController@update');
    Route::put('sessions/view/{session}', 'SessionApiController@view');
    Route::delete('sessions/delete/{session}', 'SessionApiController@destroy');
});