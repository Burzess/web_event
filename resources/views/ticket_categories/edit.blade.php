@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Ticket Category</h1>
    <form action="{{ route('ticket_categories.update', $ticketCategory->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $ticketCategory->price) }}" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $ticketCategory->stock) }}" required>
        </div>
        <div class="form-group">
            <label for="sum_ticket">Sold Tickets</label>
            <input type="number" name="sum_ticket" id="sum_ticket" class="form-control" value="{{ old('sum_ticket', $ticketCategory->sum_ticket) }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="available" {{ old('status', $ticketCategory->status) == 'available' ? 'selected' : '' }}>Available</option>
                <option value="sold out" {{ old('status', $ticketCategory->status) == 'sold out' ? 'selected' : '' }}>Sold Out</option>
            </select>
        </div>
        <div class="form-group">
            <label for="event_id">Event</label>
            <select name="event_id" id="event_id" class="form-control">
                <option value="">-- Select Event --</option>
                @foreach ($events as $event)
                    <option value="{{ $event->id }}" {{ old('event_id', $ticketCategory->event_id) == $event->id ? 'selected' : '' }}>
                        {{ $event->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
</div>
@endsection
