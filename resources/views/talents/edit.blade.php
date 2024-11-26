@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Talent</h1>

    <form action="{{ route('talents.update', $talent->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Talent</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $talent->name) }}" required>
        </div>

        <div class="form-group mt-2">
            <label for="organizer">Organizer</label>
            <select name="organizer" id="organizer" class="form-control">
                <option value="">Pilih Organizer</option>
                @foreach($organizers as $organizer)
                    <option value="{{ $organizer->id }}" {{ $organizer->id == $talent->organizer_id ? 'selected' : '' }}>
                        {{ $organizer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="image">Image</label>
            <select name="image" id="image" class="form-control">
                <option value="">Pilih Image</option>
                @foreach($images as $image)
                    <option value="{{ $image->id }}" {{ $image->id == $talent->image_id ? 'selected' : '' }}>
                        {{ $image->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option value="">Pilih Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $role->id == $talent->role_id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning mt-4">Update Talent</button>
    </form>
</div>
@endsection
