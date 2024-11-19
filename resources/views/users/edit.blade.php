@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required>
        
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required>
        
        <label for="password">Password (leave blank to keep current)</label>
        <input type="password" name="password" id="password">
        
        <label for="role">Role</label>
        <select name="role" id="role">
            <option value="">Select Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>

        <label for="organizer">Organizer</label>
        <select name="organizer" id="organizer">
            <option value="">Select Organizer</option>
            @foreach($organizers as $organizer)
                <option value="{{ $organizer->id }}" {{ $organizer->id == $user->organizer_id ? 'selected' : '' }}>{{ $organizer->name }}</option>
            @endforeach
        </select>

        <button type="submit">Update</button>
    </form>
@endsection
