@extends('layouts.app')

@section('content')
    <h1>Create User</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="@error('name') is-invalid @enderror">
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="@error('email') is-invalid @enderror">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required class="@error('password') is-invalid @enderror">
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    
        <label for="role">Role</label>
        <select name="role" id="role" class="@error('role') is-invalid @enderror">
            <option value="">Select Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        @error('role')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    
        <label for="organizer">Organizer</label>
        <select name="organizer" id="organizer" class="@error('organizer') is-invalid @enderror">
            <option value="">Select Organizer</option>
            @foreach($organizers as $organizer)
                <option value="{{ $organizer->id }}" {{ old('organizer') == $organizer->id ? 'selected' : '' }}>
                    {{ $organizer->name }}
                </option>
            @endforeach
        </select>
        @error('organizer')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    
        <button type="submit">Create</button>
    </form>
    
@endsection
