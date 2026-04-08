@extends('layouts.app')

@section('title', 'All notes')
@section('content')
    @isset($test)
        {{ $test }}
    @endisset
    <h1 class="text-2xl font-bold mb-4">All Notes</h1>
    <p>Here you can find all your notes.</p>
@endsection