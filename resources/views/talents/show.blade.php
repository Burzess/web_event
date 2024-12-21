@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Talent</h1>
    <div class="mb-3">
        <strong>Nama Talent:</strong> {{ $talent->name }}
    </div>

    <div class="mb-3">
        <strong>Organizer:</strong>
        @if($talent->organizer)
            {{ $talent->organizer->name }}
        @else
            Tidak ada Organizer
        @endif
    </div>

    <div class="mb-3">
        <strong>Image:</strong>
        @if($talent->image)
            <img src="{{ asset('storage/' . $talent->image->file_path) }}" alt="{{ $talent->image->name }}" width="100">
        @else
            Tidak ada Image
        @endif
    </div>

    <div class="mb-3">
        <strong>Role:</strong>
        @if($talent->role)
            {{ $talent->role->name }}
        @else
            Tidak ada Role
        @endif
    </div>

    <a href="{{ route('talents.index') }}" class="btn btn-primary">Kembali ke Daftar Talent</a>
</div>
@endsection
