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
$c = (object)[
    'projectsController'    => ProjectController::class,
    'groupsController'       => GroupController::class,
    'participantsController' => ParticipantController::class,
    'meetingsController'        => MeetingController::class,
];
Route::group([],function () use($c){
    //  PROJECTS
    Route::post('projects', $c->projectsController.'@store')->name('projects.store');
    Route::get('projects', 'ProjectController@index')->name('projects.index');
    Route::get('projects/{project}', 'ProjectController@show')->name('projects.show');
    Route::put('projects/{project}', 'ProjectController@update')->name('projects.update');
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
    Route::post('meetings', $c->meetingsController.'@store');
    Route::get('meetings', 'MeetingController@index');
    Route::get('meetings/{meeting}', 'MeetingController@show');
    Route::put('meetings/{meeting}', 'MeetingController@update');
    Route::delete('meetings/{meeting}', 'MeetingController@destroy');
    Route::get('meetings/{meeting}/groups', 'MeetingController@findGroup');

    Route::post('/check-in', 'CheckInController@check');
});


