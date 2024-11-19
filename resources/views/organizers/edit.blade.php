@extends('layouts.app')

@section('content')
    <h1>Edit Organizer</h1>
    <form action="{{ route('organizers.update', $organizer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Organizer Name</label>
        <input type="text" name="name" id="name" value="{{ $organizer->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
