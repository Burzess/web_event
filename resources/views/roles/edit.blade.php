@extends('layouts.app')

@section('content')
    <h1>Edit Role</h1>
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Role Name</label>
        <input type="text" name="name" id="name" value="{{ $role->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
