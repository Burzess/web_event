@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Talent</h1>
    <a href="{{ route('talents.create') }}" class="btn btn-primary mb-3">Tambah Talent Baru</a>
    <table class="table">
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
                    <td>{{ $talent->organizer->name ?? 'Tidak ada organizer' }}</td>
                    <td>{{ $talent->image ? $talent->image->file_path : 'Tidak ada gambar' }}</td>
                    <td>{{ $talent->role->name ?? 'Tidak ada role' }}</td>
                    <td>
                        <a href="{{ route('talents.show', $talent->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('talents.edit', $talent->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('talents.destroy', $talent->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus talent ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
