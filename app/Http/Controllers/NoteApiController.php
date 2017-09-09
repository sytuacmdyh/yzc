<?php

namespace App\Http\Controllers;

use App\Note;
use App\Jobs\TestDelay;
use Illuminate\Http\Request;

class NoteApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('getToken');
    }

    public function testApi(){
        return 'yzccz';
    }

    public function getToken(){
        return \App\User::find(1)->createToken('testToken')->accessToken;
    }

    public function listNotes()
    {
        TestDelay::dispatch(5);
    	return Note::all();
    }
}
