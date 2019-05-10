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

Route::post('projects', 'ProjectController@store');
Route::get('projects', 'ProjectController@index');
Route::get('projects/{project}', 'ProjectController@show');
Route::put('projects/{project}', 'ProjectController@update');
Route::delete('projects/{project}', 'ProjectController@destroy');
Route::post('groups', 'GroupController@store');
Route::get('groups', 'GroupController@index');
Route::get('groups/{group}', 'GroupController@show');
Route::put('groups/{group}', 'GroupController@update');
Route::delete('groups/{group}', 'GroupController@destroy');
