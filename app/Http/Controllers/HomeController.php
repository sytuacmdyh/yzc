<?php

namespace App\Http\Controllers;

use App\Note;
use function dump;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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

    public function health()
    {
        return JsonResponse::create(['time' => now()->toDateTimeString(), 'msg' => 'welcome to yzc']);
    }

    public function recordIp(Request $request)
    {
        Redis::connection()->set('200ip', $request->header('ali-cdn-real-ip'));
        return $request->header('ali-cdn-real-ip');
    }
}
