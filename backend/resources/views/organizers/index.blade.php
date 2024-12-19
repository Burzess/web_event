@extends('layouts.admin');

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Organizers</li>
            </ol>
            <div class="card mb-4">
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Organizers
                    <button class="btn btn-success btn-sm float-end" data-bs-toggle="modal"
                        data-bs-target="#createOrganizerModal">
                        <i class="fas fa-plus"></i> Create Role
                    </button>
                </div>
                <div class="card-body">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organizers as $organizer)
                                <tr>
                                    <td>{{ $organizer->name }}</td>
                                    <td>{{ $organizer->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm edit-organizer-btn"
                                            data-id="{{ $organizer->id }}"
                                            data-name="{{ $organizer->name }}"
                                            data-bs-toggle="modal" data-bs-target="#editOrganizerModal">
                                            Edit
                                        </button>

                                        <form action="{{ route('organizers.destroy', $organizer->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    @include('partials.admin.organizerModal')
@endsection
