<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function(){

    Route::post('register', 'AuthenticationController@register');
    Route::post('login', 'AuthenticationController@login');

    Route::middleware('auth:api')->group(function(){
        Route::post('logout', 'AuthenticationController@logout');
    });

});

Route::get('movies', 'MovieController@index')->middleware('auth:api');

Route::prefix('movies')->group(function(){

    Route::get('discover', 'MovieController@discover');
    Route::get('top_rated', 'MovieController@top_rated');
    Route::get('upcoming', 'MovieController@upcoming');
    Route::get('details/{movie_id}', 'MovieController@details');

});

