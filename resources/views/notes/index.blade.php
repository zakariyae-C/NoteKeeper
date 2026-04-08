@extends('layouts.app')

@section('title', 'All notes')
@section('content')
    @isset($test)
        {{ $test }}
    @endisset
    @foreach ($notes as $note)
        <h1 class="text-2xl font-bold mb-4">{{ $note->title }}</h1>
        <p>{{ $note->description }}</p>
    @endforeach
@endsection