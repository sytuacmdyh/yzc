<?php

namespace App\Http\Controllers;

use AlibabaCloud\Client\AlibabaCloud;
use App\Jobs\UploadToOss;
use App\Share;
use Cache;
use Carbon\Carbon;
use function compact;
use Illuminate\Http\Request;
use function json_encode;

class ShareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shares       = Share::whereUserId(\Auth::user()->id)->orderBy('updated_at', 'desc')->take(10)->get();
        $sharesPublic = Share::whereIsPublic(true)->orderBy('updated_at', 'desc')->take(10)->get();
        $urlPrefix    = 'https://cdn.yzccz.cn/';

        $shares->map(function (Share $item) use ($urlPrefix) {
            if ($item->file_name)
                $item->file_name = $urlPrefix . $item->file_name;
        });
        $sharesPublic->map(function (Share $item) use ($urlPrefix) {
            if ($item->file_name)
                $item->file_name = $urlPrefix . $item->file_name;
        });

        return view('share.index', compact('shares', 'sharesPublic'));
    }

    /**
     * @return string
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    private function getOssConfig()
    {
        $result = AlibabaCloud::sts()->v20150401()->assumeRole()
            ->withRoleSessionName('ossToken')
            ->withDurationSeconds(60 * 15)
            ->withRoleArn("acs:ram::1822006838390050:role/yzc-admin")
            ->withPolicy('
 {
    "Statement": [
        {
            "Action": [
                "oss:PutObject"
            ],
            "Effect": "Allow",
            "Resource": [
                "acs:oss:*:*:yzc-dyh-hz/*",
                "acs:oss:*:*:yzc-dyh-hz"
            ]
        }
    ],
    "Version": "1"
}
        ')->request()->toArray();

        return json_encode([
            "region"          => 'oss-cn-hangzhou',
            "accessKeyId"     => $result['Credentials']['AccessKeyId'],
            "accessKeySecret" => $result['Credentials']['AccessKeySecret'],
            "stsToken"        => $result['Credentials']['SecurityToken'],
            "bucket"          => 'yzc-dyh-hz'
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function create()
    {
        $key    = 'ossConfig';
        $config = Cache::get($key);
        if (!$config) {
            $config = $this->getOssConfig();
            Cache::add($key, $config, 15);
        }

        return view('share.create', compact('config'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'is_public' => 'required|boolean',
            'shareData' => 'required_without:file',
            'file'      => 'required_without:shareData',
        ]);

        $share            = new Share();
        $share->user_id   = $request->user()->id;
        $share->data      = $request->input('shareData') ?: '';
        $share->type      = 'other';
        $share->is_public = $request->input('is_public');
        $share->file_name = $request->input('file');

        $share->save();

        return redirect(route('shares.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Share $share
     * @return \Illuminate\Http\Response
     */
    public function show(Share $share)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Share $share
     * @return \Illuminate\Http\Response
     */
    public function edit(Share $share)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Share $share
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Share $share)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Share $share
     * @return \Illuminate\Http\Response
     */
    public function destroy(Share $share)
    {
        //
    }
}
