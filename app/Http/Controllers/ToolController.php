<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fontPrune(Request $request)
    {
        $this->validate($request, [
            'file_ttf' => 'file|required|mimes:ttf',
            'file_txt' => 'file|required|mimes:txt',
        ]);

        $userId = $request->user()->id;
        $request->file('file_ttf')->storeAs('fontPruner/' . $userId, 'input.ttf');
        $request->file('file_txt')->storeAs('fontPruner/' . $userId, 'input.txt');

        $downloadUrl = 'http://www.baidu.com';
        dd($downloadUrl);
//        dd($downloadUrl);
        return response()->download('');
    }
}
