<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
        ]);

        Note::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'user_id' => Auth::id(),
        ]);

        return to_route('notes.index');
        
    }

    // Dsiplay one note info
    public function show(Note $note){
        return view('notes.show', ['note' => $note]);
    }

    // Delete notes
    public function destroy(Note $note){
        $note->delete();
        return to_route('notes.index');
    }
}
