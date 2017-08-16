<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
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
    public function index(Request $request)
    {
        $status = $request->input('status');
        $deleted = $request->input('deleted');

        $pendingCount = Note::where('status','pending')->count();
        $completedCount = Note::where('status','completed')->count();
        $deletedCount = Note::onlyTrashed()->count();
        $counts = [
            'pendingCount'=>$pendingCount,
            'completedCount'=>$completedCount,
            'deletedCount'=>$deletedCount,
        ];

        $notes = Note::when($status,function ($query) use ($status) {
            return $query->where('status',$status);
        },function($query){
            return $query->where('status','pending');
        })->when($deleted,function ($query) {
            return $query->onlyTrashed();
        })->paginate(15);

        return view('note.index', 
            ['notes' => $notes, 
            'counts' => $counts, 
            'status'=> $status, 
            'deleted' => $deleted]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:90',
            'classification' => 'required|max:90',
        ]);

        $title = $request->input('title');
        $content = $request->input('content');
        $classification = $request->input('classification');

        $note = new Note;
        $note->title = $title;
        $note->content = $content;
        $note->type = $classification;
        $note->user_id = $request->user()->id;
        $note->save();

        return "ok";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $status = $request->input('status');

        $note->status = $status;
        $note->save();

        return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return 'ok';
    }
}
