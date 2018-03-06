<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class XiaoAiApiController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth:api');
    }

    public function test(Request $request)
    {
        Log::error(json_encode([
            'header' => $request->header(),
            'body'   => json_decode($request->getContent(), true),

            'get'  => $_GET,
            'post' => $_POST,
        ]));

        $body = json_decode($request->getContent(), true);

        $text = '';
        switch ($body['query']) {
            case '你瞅啥':
                $text = '瞅你咋地';
                break;
            case '你敢再说一遍':
                $text = '就瞅你咋地';
                break;
            default:
                $text = '来福祥伤害啊, 你可以说“你瞅啥”';
        }

        return [
            'version'        => $body['version'],
            'is_session_end' => false,
            'response'       => [
                'to_speak' => [
                    'type' => 0,
                    'text' => $text,
                ],
            ],
        ];
    }
}
