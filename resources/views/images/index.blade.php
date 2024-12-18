@extends('layouts.app')

@section('content')
    <h1>All Images</h1>
    <a href="{{ route('images.create') }}" class="btn btn-primary mb-3">Add New Image</a>

    {{-- Tampilkan pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td>{{ $image->name }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->name }}" width="100">
                    </td>
                    <td>
                        <a href="{{ route('images.edit', $image->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('images.destroy', $image->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
