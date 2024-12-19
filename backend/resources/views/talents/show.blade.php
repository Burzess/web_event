@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Talent</h1>

    <div class="mb-3">
        <strong>Nama Talent:</strong> {{ $talent->name }}
    </div>
    <div class="mb-3">
        <strong>Organizer:</strong> {{ $talent->organizer->name ?? 'Tidak ada' }}
    </div>
    <div class="mb-3">
        <strong>Image:</strong> {{ $talent->image->name ?? 'Tidak ada' }}
    </div>
    <div class="mb-3">
        <strong>Role:</strong> {{ $talent->role->name ?? 'Tidak ada' }}
    </div>
    <a href="{{ route('talents.index') }}" class="btn btn-primary">Kembali ke Daftar Talent</a>
</div>
@endsection
