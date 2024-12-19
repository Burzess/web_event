@extends('layouts.app')

@section('content')
    <h1>Users</h1>
    <a href="{{ route('users.create') }}">Create New User</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Organizer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ($user->role)->name ?? 'N/A' }}</td> <!-- Menggunakan optional untuk menghindari error jika relasi tidak ada -->
                    <td>{{ ($user->organizer)->name ?? 'N/A' }}</td> <!-- Menggunakan optional untuk menghindari error jika relasi tidak ada -->
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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
