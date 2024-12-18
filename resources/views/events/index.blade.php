@extends('layouts.app')

@section('content')
    <h1>Event List</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Create New Event</a>

    @if ($events->isEmpty())
        <p>No events found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Venue Name</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Organizer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->date->format('F j, Y') }}</td>
                        <td>{{ $event->venue_name }}</td>
                        <td>{{ ucfirst($event->status) }}</td>
                        <td>{{ $event->category ? $event->category->name : 'N/A' }}</td>
                        <td>{{ $event->organizer ? $event->organizer->name : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
