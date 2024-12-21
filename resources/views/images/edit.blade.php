@extends('layouts.app')

@section('content')
    <h1>Edit Image</h1>
    <form action="{{ route('images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $image->name }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <small>Leave blank if you don't want to change the image.</small>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
