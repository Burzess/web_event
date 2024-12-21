@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kategori Baru</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="organizer_id">Organizer</label>
            <select name="organizer_id" id="organizer_id" class="form-control">
                @foreach ($organizers as $organizer)
                    <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
</div>
@endsection
