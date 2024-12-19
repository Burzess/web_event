<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Acara</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Detail Acara</h1>
        <div class="card">
            <div class="card-header">
                {{ $event->title }}
            </div>
            <div class="card-body">
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
                <p><strong>Venue:</strong> {{ $event->venue_name }}</p>
                <p><strong>Kategori:</strong> {{ $event->category->name ?? '-' }}</p>
                <p><strong>Deskripsi:</strong> {{ $event->about }}</p>
                <p><strong>Status:</strong> {{ ucfirst($event->status) }}</p>
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>
