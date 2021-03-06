<?php

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Sts\StsVersion;
use AlibabaCloud\Sts\V20150401\StsApiResolver;
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
Route::post('/wxSendTemplate', 'NoteApiController@wxSendTemplate')->name('wxSendTemplate');
Route::post('/wxLogin', 'NoteApiController@wxLogin')->name('wxLogin');

Route::get('/test', 'NoteApiController@testApi')->name('testapi');
Route::get('/odoo/userinfo', 'NoteApiController@userInfo')->name('odoo_userInfo');
Route::get('/getNotes', 'NoteApiController@listNotes')->name('getNotes');

Route::post('/xiaoai', 'XiaoAiApiController@test');

Route::get('/recordIp', 'HomeController@recordIp');
