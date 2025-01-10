<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">EventApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @if(auth()->check())
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item"><a class="nav-link" href="/admin/orders">Orders</a></li>
                    @elseif(auth()->user()->role === 'organizer')
                        <li class="nav-item"><a class="nav-link" href="/organizer/talents">Talents</a></li>
                        <li class="nav-item"><a class="nav-link" href="/organizer/events">Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="/organizer/orders">Orders</a></li>
                    @elseif(auth()->user()->role === 'owner')
                        <li class="nav-item"><a class="nav-link" href="/owner/organizers">Organizers</a></li>
                        <li class="nav-item"><a class="nav-link" href="/owner/events">Approved Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="/owner/orders">Orders</a></li>
                    @endif
                @endif
            </ul>
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
