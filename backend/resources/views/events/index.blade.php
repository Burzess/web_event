<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Acara</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Acara</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Venue</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $index => $event)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
                        <td>{{ $event->venue_name }}</td>
                        <td>{{ $event->category->name ?? '-' }}</td>
                        <td>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada acara tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
