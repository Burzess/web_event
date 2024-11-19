@extends('layouts.app')

@section('content')
    <h1>Organizers</h1>
    <a href="{{ route('organizers.create') }}">Create New Organizer</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($organizers as $organizer)
                <tr>
                    <td>{{ $organizer->name }}</td>
                    <td>
                        <a href="{{ route('organizers.edit', $organizer->id) }}">Edit</a>
                        <form action="{{ route('organizers.destroy', $organizer->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
