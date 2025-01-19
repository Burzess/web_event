<x-app title="Organizer | Talents">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Talent Baru</button>
    </div>
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Talent Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('organizer.talents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Talent</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Talent</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Talent</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($talents as $talent)
                <tr>
                    <td>{{ $talent->id }}</td>
                    <td>{{ $talent->name }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $talent->id }}">Edit</button>
                        <div class="modal fade" id="editModal{{ $talent->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $talent->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $talent->id }}">Edit Talent</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('organizer.talents.update', $talent->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama Talent</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $talent->name }}" required>
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Upload Image</label>
                                                <input type="file" class="form-control" id="image" name="image">
                                                @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('organizer.talents.destroy', $talent->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app>
