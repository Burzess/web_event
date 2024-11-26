@extends('layouts.app')

@section('content')
    <h1>Daftar Talent</h1>
    <a href="{{ route('talents.create') }}" class="btn btn-primary mb-3">Tambah Talent Baru</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Talent</th>
                <th>Organizer</th>
                <th>Image</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($talents as $talent)
                <tr>
                    <td>{{ $talent->id }}</td>
                    <td>{{ $talent->name }}</td>
                    <td>{{ $talent->organizer->name ?? 'Tidak ada' }}</td>
                    <td>{{ $talent->image->name ?? 'Tidak ada' }}</td>
                    <td>{{ $talent->role->name ?? 'Tidak ada' }}</td>
                    <td>
                        <a href="{{ route('talents.show', $talent->id) }}" class="btn btn-info">Lihat</a>
                        <a href="{{ route('talents.edit', $talent->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('talents.destroy', $talent->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
