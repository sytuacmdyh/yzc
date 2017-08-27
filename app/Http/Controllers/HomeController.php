<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function testApi(){
        return 'yzccz';
    }

    public function getToken(){
        return \App\User::find(1)->createToken('testToken')->accessToken;
    }
}
