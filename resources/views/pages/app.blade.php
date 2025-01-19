<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SEMINA')</title>
    @vite(['resources/scss/main.css', 'resources/js/app.js'])
</head>

<body>
    @include('components.navbar')

    <!-- Main Content -->
    @yield('content')
</body>

</html>
