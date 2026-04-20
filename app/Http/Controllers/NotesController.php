<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Notifications\NoteCreateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NotesController extends Controller
{
    // Display all notes
    public function index(Request $request)
    {
        $category = $request->query('category');
        $query = Note::where('user_id', Auth::id());
        if ($category != null) {
            $query->where('category', $category);
        }
        $notes = $query->get();

        return view('notes.index', ['notes' => $notes]);
    }

    // Store new note
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
        ]);

        $note = Note::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'user_id' => Auth::id(),
        ]);

        Auth::user()->notify(new NoteCreateNotification($note));
        // auth()->user()->notify(new NoteCreateNotification($note));

        return to_route('notes.index')->with('success', 'Note has been created successuly.');

    }

    // Dsiplay one note info
    public function show(Note $note)
    {
        // Policy to prevent users entering notes that not belongs to them
        Gate::authorize('view', $note);

        return view('notes.show', ['note' => $note]);
    }

    // Edit notes
    public function update(Request $request, Note $note)
    {
        Gate::authorize('update', $note);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
        ]);

        $note->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        return to_route('notes.index')->with('success', 'Note has been updated successuly.');
    }

    // Delete notes
    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);
        $note->delete();

        return to_route('notes.index')->with('success', 'Note has been deleted successuly.');
    }
}
