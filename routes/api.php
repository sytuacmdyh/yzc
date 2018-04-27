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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/getToken', 'NoteApiController@getToken')->name('getToken');

Route::get('/test', 'NoteApiController@testApi')->name('testapi');
Route::get('/getNotes', 'NoteApiController@listNotes')->name('getNotes');

Route::post('/xiaoai', 'XiaoAiApiController@test');
