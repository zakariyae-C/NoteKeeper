<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        if ($category == 'personal') {
            return view('notes.index', ["test" => $category]);
        } elseif ($category == 'work') {
            return view('notes.index', ["test" => $category]);
        } elseif ($category == 'idea') {
            return view('notes.index', ["test" => $category]);
        }
        return view('notes.index');
    }
}
