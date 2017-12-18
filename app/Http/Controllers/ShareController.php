<?php

namespace App\Http\Controllers;

use App\Share;
use Illuminate\Http\Request;

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
        $shares       = Share::whereUserId(\Auth::user()->id)->orderBy('updated_at', 'desc')->take(10)->get()->toArray();
        $sharesPublic = Share::whereIsPublic(true)->orderBy('updated_at', 'desc')->take(10)->get()->toArray();
        $urlPrefix    = \Storage::url('');
        return view('share.index', compact('shares', 'sharesPublic', 'urlPrefix'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('share.create');
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
            'file'      => 'required_without:shareData|file',
        ]);

        $file     = $request->file('file');
        $filePath = $file->storeAs('uploads/' . $request->user()->id, $file->getClientOriginalName());

        $share            = new Share();
        $share->user_id   = $request->user()->id;
        $share->data      = $request->input('shareData')?:'';
        $share->type      = 'other';
        $share->is_public = $request->input('is_public');
        $share->file_name = $filePath;
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
