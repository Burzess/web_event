<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD</title>
</head>
<body>
    <nav>
        <a href="{{ route('roles.index') }}">Roles</a>
        <a href="{{ route('organizers.index') }}">Organizers</a>
        <a href="{{ route('users.index') }}">Users</a>
    </nav>
    
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
