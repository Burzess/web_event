@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Talent</h1>
    <form action="{{ route('talents.update', $talent->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Talent</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $talent->name) }}" required>
        </div>
        <div class="form-group">
            <label for="organizer">Organizer</label>
            <select name="organizer_id" id="organizer" class="form-control">
                <option value="">Pilih Organizer</option>
                @foreach ($organizers as $organizer)
                    <option value="{{ $organizer->id }}" {{ $organizer->id == $talent->organizer_id ? 'selected' : '' }}>
                        {{ $organizer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <select name="image_id" id="image" class="form-control">
                <option value="">Pilih Image</option>
                @foreach ($images as $image)
                    <option value="{{ $image->id }}" {{ $image->id == $talent->image_id ? 'selected' : '' }}>
                        {{ $image->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role_id" id="role" class="form-control">
                <option value="">Pilih Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $role->id == $talent->role_id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
        <a href="{{ route('talents.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection
