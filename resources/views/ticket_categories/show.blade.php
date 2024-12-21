@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ticket Category Details</h1>
    <a href="{{ route('ticket_categories.index') }}" class="btn btn-secondary mb-3">Back to List</a>

    <div class="card">
        <div class="card-header">
            Ticket Category ID: {{ $ticketCategory->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Event: {{ $ticketCategory->event->title ?? 'No Event' }}</h5>
            <p class="card-text"><strong>Price:</strong> ${{ $ticketCategory->price }}</p>
            <p class="card-text"><strong>Stock:</strong> {{ $ticketCategory->stock }}</p>
            <p class="card-text"><strong>Sold Tickets:</strong> {{ $ticketCategory->sum_ticket }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($ticketCategory->status) }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $ticketCategory->created_at->format('Y-m-d H:i') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $ticketCategory->updated_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>
</div>
@endsection