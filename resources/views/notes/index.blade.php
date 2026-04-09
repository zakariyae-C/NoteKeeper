@extends('layouts.app')

@section('title', 'All notes')
@section('content-class', 'p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4')
@section('content')
    @foreach ($notes as $note)
        <div class="card card-dash custom-cards bg-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <h2 class="card-title">{{ $note->title }}</h2>
                    <a href="{{ route('notes.index', ['category' => $note->category ]) }}" class="note-category {{ $note->category }}">{{ $note->category }}</a>
                </div>
                <p class="overflow-hidden text-ellipsis">{{ $note->description }}</p>
                <div class="card-actions justify-end action-icons flex gap-3 mt-3">
                    <a href="" class="tooltip tooltip-top" data-tip="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="{{ route('notes.show', $note->id) }}" class="tooltip tooltip-top bg-accent" data-tip="view"><i class="fa-regular fa-eye"></i></a>
                    <form method="POST" action="{{ route('notes.destroy', $note->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="cursor-pointer tooltip tooltip-top bg-error" data-tip="delete" onclick="return confirm('Are you sure you want to delete this note?')">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    
@endsection