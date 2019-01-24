<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notes = $request->user()->notes;
        return response()->json(['notes' => $notes], 200);
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
            'title' => 'required|string',
            'body' => 'required|string',
            'favorite' => 'boolean',
        ]);

        $user = $request->user();
        $note = $user->notes()->create($request->all());

        return response()->json(['note' => $note], 201);
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
        $this->validate($request, [
            'title' => 'string',
            'body' => 'string',
            'favorite' => 'boolean',
        ]);
        
        $note->fill($request->only('title', 'body', 'favorite'));
        $note->save();

        return response()->json([
            'note' => $note, 'message' => 'Note updated successfully!'
        ], 200);
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
        return response()->json(['message' => 'Note deleted successfully!'], 200);
    }
}
