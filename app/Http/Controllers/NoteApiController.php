<?php

namespace App\Http\Controllers;

use App\Note;
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
    	return Note::all();
    }
}
