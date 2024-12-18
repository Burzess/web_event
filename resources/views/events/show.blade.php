@extends('layouts.app')

@section('content')
    <h1>{{ $event->title }}</h1>
    <p><strong>Date:</strong> {{ $event->date->format('F j, Y') }}</p>
    <p><strong>About:</strong> {{ $event->about }}</p>
    <p><strong>Tagline:</strong> {{ $event->tagline ?? 'N/A' }}</p>
    <p><strong>Venue:</strong> {{ $event->venue_name }}</p>
    <p><strong>Status:</strong> <span class="badge bg-{{ $event->status == 'active' ? 'success' : 'danger' }}">{{ ucfirst($event->status) }}</span></p>

    <h3>Details</h3>
    <div>
        <strong>Category:</strong> {{ $event->category ? $event->category->name : 'No category' }}
    </div>

    <div>
        <strong>Image ACARA:</strong>
        @if($event->image)
            <img src="{{ asset('storage/' . $event->image->file_path) }}" alt="{{ $event->image->name }}" width="100">
        @else
            Tidak ada Image
        @endif
    </div>

    <div>
        <strong>Image Talent:</strong>
        @if($event->image)
            <img src="{{ asset('storage/' . $event->talent->image->file_path) }}" alt="{{ $event->talent->image->name }}" width="100">
        @else
            Tidak ada Image
        @endif
    </div>
    <div>
        <strong>Talent:</strong> {{ $event->talent ? $event->talent->name : 'No talent' }}
    </div>
    <div>
        <strong>Organizer:</strong> {{ $event->organizer ? $event->organizer->name : 'No organizer' }}
    </div>

    <a href="{{ route('events.index') }}" class="btn btn-secondary mt-3">Back to Events</a>
@endsection
