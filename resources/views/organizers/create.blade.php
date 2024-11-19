@extends('layouts.app')

@section('content')
    <h1>Create Organizer</h1>
    <form action="{{ route('organizers.store') }}" method="POST">
        @csrf
        <label for="name">Organizer Name</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Create</button>
    </form>
@endsection
