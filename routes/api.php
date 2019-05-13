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

//  PROJECTS
Route::post('projects', 'ProjectController@store');
Route::get('projects', 'ProjectController@index');
Route::get('projects/{project}', 'ProjectController@show');
Route::put('projects/{project}', 'ProjectController@update');
Route::delete('projects/{project}', 'ProjectController@destroy');
Route::get('projects/{project}/groups', 'ProjectController@findGroup');

// GROUPS
Route::post('groups', 'GroupController@store');
Route::get('groups', 'GroupController@index');
Route::get('groups/{group}', 'GroupController@show');
Route::put('groups/{group}', 'GroupController@update');
Route::delete('groups/{group}', 'GroupController@destroy');
Route::get('groups/{group}/participants', 'GroupController@findParticipant');
Route::get('groups/{group}/participantsMeeting', 'GroupController@findParticipantMeeting');

// PARTICIPANTS
Route::post('participants', 'ParticipantController@store');
Route::get('participants', 'ParticipantController@index');
Route::get('participants/{participant}', 'ParticipantController@show');
Route::put('participants/{participant}', 'ParticipantController@update');
Route::delete('participants/{participant}', 'ParticipantController@destroy');
Route::get('participants/{participant}/meetings', 'ParticipantController@findMeeting');


// MEETINGS
Route::post('meetings', 'MeetingController@store');
Route::get('meetings', 'MeetingController@index');
Route::get('meetings/{meeting}', 'MeetingController@show');
Route::put('meetings/{meeting}', 'MeetingController@update');
Route::delete('meetings/{meeting}', 'MeetingController@destroy');
Route::get('meetings/{meeting}/groups', 'MeetingController@findGroup');

Route::post('/check-in', 'CheckInController@check');
