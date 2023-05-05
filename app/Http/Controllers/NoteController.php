<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class NoteController extends Controller
{
    public function index(Request $request)
    {

        $texto = trim($request->get('texto'));
        /* $note = DB::table('notes')
            ->select('id', 'title', 'slug', 'description', 'hora')
            ->where('title', 'LIKE', '%' . $texto . '%')
            ->orwhere('', 'LIKE', '%' . $texto . '%'); */

        $notes = Note::where('user_id', auth()->user()->id)
            ->where('title', 'LIKE', '%' . $texto . '%')
            ->orwhere('user_id', 'id', 'description', 'LIKE', '%' . $texto . '%')
            ->latest('id')
            ->paginate(10);
        return view('admin.notes.index', compact('notes', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'user_id' => 'required|integer',
            'slug' => 'required|unique:notes',
            'file' => 'required'
        ]);

        $note = Note::create($request->all());

        if ($request->file('file')) {
            $url = Storage::put('public/images', $request->file('file'));

            $file = new File();
            $file->title = $url;
            $file->note_id = $note->id;
            $file->save();
        }


        return redirect()->route('note.edit', $note)
            ->with('info', 'La Nota se creó con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return view('admin.notes.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('admin.notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required',
            'slug' => "required|unique:notes,slug,$note->id",
            'file' => 'required'
        ]);
        $note->update($request->all());

        return redirect()->route('note.edit', $note)
            ->with('info', 'la Nota se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('note.index')->with('info', 'la Nota se elimino con éxito');
    }
}
