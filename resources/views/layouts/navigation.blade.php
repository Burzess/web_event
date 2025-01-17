<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand font-bold mr-8" href="#">Dashboard</a>
        <div class="d-flex navbar-collapse">
            <ul class="navbar-nav me-auto">
                @auth
                    @if (auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                                href="/admin/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}"
                                href="/admin/orders">Orders</a>
                        </li>
                    @elseif(auth()->user()->hasRole('organizer'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('organizer/categories') ? 'active' : '' }}"
                                href="/organizer/categories">Categories</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->is('organizer/talents') ? 'active' : '' }}"
                                href="/organizer/talents">Talents</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('organizer/talents') ? 'active' : '' }}"
                                href="/organizer/talents">Talents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('organizer/events') ? 'active' : '' }}"
                                href="/organizer/events">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('organizer/orders') ? 'active' : '' }}"
                                href="/organizer/orders">Orders</a>
                        </li>
                    @elseif(auth()->user()->hasRole('owner'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('owner/organizers') ? 'active' : '' }}"
                                href="{{ route('owner.organizers.index') }}">Organizers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('owner/events') ? 'active' : '' }}"
                                href="/owner/events">Approved Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('owner/orders') ? 'active' : '' }}"
                                href="/owner/orders">Orders</a>
                        </li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }} -
                            {{ auth()->user()->hasRole('owner') ? 'owner' : (auth()->user()->hasRole('organizer') ? 'organizer' : 'admin') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
