<?php

namespace App\Http\Controllers;

use App\Note;
use App\Jobs\TestDelay;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class NoteApiController extends Controller
{
    private $wx_app_id;
    private $wx_app_secret;
    private $wx_token_key = 'WxAccessToken';

    public function __construct()
    {
        if (!\App::environment('local')) {
            $this->middleware('auth:api')->except('getToken');
        }
        $this->wx_app_id     = config('app.wx_app_id');
        $this->wx_app_secret = config('app.wx_app_secret');
    }

    private function getWxAccessToken()
    {
        $accessToken = \Cache::get($this->wx_token_key);
        if (!$accessToken) {
            $jsonResponse = (new Client())->get('https://api.weixin.qq.com/cgi-bin/token', [
                'query' => [
                    'grant_type' => 'client_credential',
                    'appid'      => $this->wx_app_id,
                    'secret'     => $this->wx_app_secret,
                ]
            ])->getBody()->getContents();

            $res         = json_decode($jsonResponse, true);
            $accessToken = $res['access_token'];
            \Cache::set($this->wx_token_key, $accessToken, $res['expires_in'] / 60);
        }
        return $accessToken;
    }

    public function testApi()
    {
        return 'yzccz';
    }

    public function getToken()
    {
        return \App\User::find(1)->createToken('testToken')->accessToken;
    }

    public function listNotes()
    {
        TestDelay::dispatch(5);
        return Note::all();
    }

    public function wxSendTemplate(Request $request)
    {
        $token = $this->getWxAccessToken();

        $form_id     = $request->formId;
        $touser      = $request->touser;
        $template_id = 'SrQoNUrohGe3w_MnaybJs2_ldUmn2PFKuPf4htwZCi8';
        $data        = [];

        $res = (new Client())->post("https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=$token", [
            'json' => compact('form_id', 'touser', 'template_id', 'data')
        ])->getBody()->getContents();

        return json_decode($res, true);
    }

    public function wxLogin(Request $request)
    {
        $code = $request->code;

        $jsonResponse = (new Client())->get('https://api.weixin.qq.com/sns/jscode2session', [
            'query' => [
                'grant_type' => 'authorization_code',
                'appid'      => $this->wx_app_id,
                'secret'     => $this->wx_app_secret,
                'js_code'    => $code
            ]
        ])->getBody()->getContents();

        $res = json_decode($jsonResponse, true);

        return $res;
    }
}
