<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Laravel CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
                    <a class="nav-link" href="{{ route('organizers.index') }}">Organizers</a>
                    <a class="nav-link" href="{{ route('images.index') }}">Images</a>
                    <a class="nav-link" href="{{ route('talents.index') }}">Talents</a>
                    <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                    <a class="nav-link" href="{{ route('events.index') }}">Events</a>
                    <a class="nav-link" href="{{ route('ticket_categories.index') }}">Ticket Categories</a>
                    <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                </div>
            </div>
        </nav>
    
        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Content Section -->
        <div class="content mt-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
