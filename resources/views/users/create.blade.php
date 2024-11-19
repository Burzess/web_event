@extends('layouts.app')

@section('content')
    <h1>Create User</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="role">Role</label>
        <select name="role" id="role">
            <option value="">Select Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>

        <label for="organizer">Organizer</label>
        <select name="organizer" id="organizer">
            <option value="">Select Organizer</option>
            @foreach($organizers as $organizer)
                <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
            @endforeach
        </select>

        <button type="submit">Create</button>
    </form>
@endsection
