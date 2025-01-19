<x-app title="Organizer | Events">
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
        <a href="{{ route('organizer.events.create') }}" class="btn btn-primary">Tambah Event</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Kategori Tiket</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->venue_name }}</td>
                    <td>{{ $event->status }}</td>
                    <td>
                        @foreach ($event->ticketCategories as $ticket)
                            <p>Harga: {{ $ticket->price }}, Stok: {{ $ticket->stock }}, Status: {{ $ticket->status }}</p>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus event ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app>
