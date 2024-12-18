@extends('layouts.app');

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    Welcome to the admin panel! Use the navigation menu to manage your application.
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                    <button class="btn btn-success btn-sm float-end" data-bs-toggle="modal"
                        data-bs-target="#createRoleModal">
                        <i class="fas fa-plus"></i> Create Role
                    </button>
                </div>
                <div class="card-body">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                {{-- <th>Created At</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    {{-- <td>{{ $role->created_at->format('d-m-Y') }}</td> --}}
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm edit-role-btn"
                                            data-id="{{ $role->id }}" data-name="{{ $role->name }}"
                                            data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                            Edit
                                        </button>

                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
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

    @include('partials.admin.roleModal')
@endsection
