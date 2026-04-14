@extends('layouts.app')

@section('title', 'All notes')

@section('content-class', 'p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4')
@section('content')
    @foreach ($notes as $note)
        <div class="card card-dash hover:scale-105 transition delay-150 duration-300 ease-in-out custom-cards bg-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <h2 class="card-title">{{ $note->title }}</h2>
                    <a href="{{ route('notes.index', ['category' => $note->category]) }}"
                        class="note-category {{ $note->category }}">{{ $note->category }}</a>
                </div>
                <p class="overflow-hidden text-ellipsis">{{ $note->description }}</p>
                <div class="card-actions justify-end action-icons flex gap-3 mt-3">
                    <!-- Button to trigger the edit modal (JS) -->
                    <button class="cursor-pointer tooltip tooltip-top bg-error edit-note-btn" data-id="{{ $note->id }}"
                        data-title="{{ $note->title }}" data-description="{{ $note->description }}"
                        data-category="{{ $note->category }}" type="button" data-tip="edit">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <a href="{{ route('notes.show', $note->id) }}" class="tooltip tooltip-top bg-accent" data-tip="view"><i
                            class="fa-regular fa-eye"></i></a>
                    <form method="POST" action="{{ route('notes.destroy', $note->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="cursor-pointer tooltip tooltip-top bg-error" data-tip="delete"
                            onclick="return confirm('Are you sure you want to delete this note?')">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for editing a note -->
    @endforeach
    <dialog id="my_modal_4" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Edit note</h3>
            <div>
                <form id="edit-note-form" method="POST" action="" class="fieldset w-full mt-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-note-id">
                    <label class="label font-semibold">Title</label>
                    <input type="text" class="input w-full" name="title" id="edit-note-title"
                        placeholder="Note title" />
                    <x-error field="title" />

                    <label class="label font-semibold">Description</label>
                    <textarea class="textarea w-full" name="description" id="edit-note-description" placeholder="Note description"></textarea>
                    <x-error field="description" />

                    <label class="label font-semibold">Category</label>
                    <select class="select w-full" name="category" id="edit-note-category">
                        <option disabled selected>Select category</option>
                        <option value="personal">Personal</option>
                        <option value="work">Work</option>
                        <option value="idea">Idea</option>
                        <option value="other">Other</option>
                    </select>
                    <x-error field="category" />

                    <button class="btn pr-btn mt-4">update</button>
                </form>
            </div>
        </div>
    </dialog>
    <div
        class="relative card card-dash custom-cards justify-center hover:bg-base-200 border-2 border-dashed border-purple-400/70">
        <button class="absolute cursor-pointer w-full h-full text-3xl" onclick="my_modal_3.showModal()">
            <i class="fa-solid fa-plus text-purple-400"></i>
        </button>
    </div>
@endsection
