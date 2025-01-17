@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Event</h1>
    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Judul Event</label>
            <input type="text" class="form-control" name="title" value="{{ $event->title }}" required>
        </div>

        <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="date" class="form-control" name="date" value="{{ $event->date }}" required>
        </div>

        <div class="form-group">
            <label for="about">Tentang Event</label>
            <textarea class="form-control" name="about" required>{{ $event->about }}</textarea>
        </div>

        <div class="form-group">
            <label for="venue_name">Lokasi</label>
            <input type="text" class="form-control" name="venue_name" value="{{ $event->venue_name }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
                <option value="active" {{ $event->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $event->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <h3>Kategori Tiket</h3>
        <div id="ticket-categories">
            @foreach ($event->ticketCategories as $index => $ticket)
                <div class="ticket-category">
                    <h5>Kategori Tiket {{ $index + 1 }}</h5>
                    <div class="form-group">
                        <label for="ticket_categories[{{ $index }}][price]">Harga</label>
                        <input type="number" class="form-control" name="ticket_categories[{{ $index }}][price]" value="{{ $ticket->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_categories[{{ $index }}][stock]">Stok</label>
                        <input type="number" class="form-control" name="ticket_categories[{{ $index }}][stock]" value="{{ $ticket->stock }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_categories[{{ $index }}][sum_ticket]">Jumlah Tiket</label>
                        <input type="number" class="form-control" name="ticket_categories[{{ $index }}][sum_ticket]" value="{{ $ticket->sum_ticket }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_categories[{{ $index }}][status]">Status</label>
                        <select class="form-control" name="ticket_categories[{{ $index }}][status]">
                            <option value="available" {{ $ticket->status == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="sold out" {{ $ticket->status == 'sold out' ? 'selected' : '' }}>Sold Out</option>
                        </select>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Update Event</button>
    </form>
</div>
@endsection
