@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label for="organizer_id">Organizer</label>
            <select name="organizer_id" id="organizer_id" class="form-control">
                @foreach ($organizers as $organizer)
                    <option value="{{ $organizer->id }}" {{ $organizer->id == $category->organizer_id ? 'selected' : '' }}>
                        {{ $organizer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
</div>
@endsection
