@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ticket Categories</h1>
    <a href="{{ route('ticket_categories.create') }}" class="btn btn-primary mb-3">Add Ticket Category</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Price</th>
                <th>Stock</th>
                <th>Sold Tickets</th>
                <th>Status</th>
                <th>Event</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketCategories as $ticketCategory)
                <tr>
                    <td>{{ $ticketCategory->price }}</td>
                    <td>{{ $ticketCategory->stock }}</td>
                    <td>{{ $ticketCategory->sum_ticket }}</td>
                    <td>{{ ucfirst($ticketCategory->status) }}</td>
                    <td>{{ $ticketCategory->event->title ?? 'No Event' }}</td>
                    <td>
                        <a href="{{ route('ticket_categories.show', $ticketCategory->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('ticket_categories.edit', $ticketCategory->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('ticket_categories.destroy', $ticketCategory->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
