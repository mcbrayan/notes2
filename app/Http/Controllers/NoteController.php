<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter;

class NoteController extends Controller
{
    public function index()
    {

        $notes = Note::where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate(10);
        return view('admin.notes.index', compact('notes'));
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
        /* dd($request); */
        $request->validate([
            'title' => 'required',
            'user_id' => 'required|integer',
            'slug' => 'required|unique:notes'
        ]);
        $note = Note::create($request->all());

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
            'slug' => "required|unique:notes,slug,$note->id"
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
