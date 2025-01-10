<aside class="bg-light border-end vh-100">
    <div class="p-3">
        <h5 class="text-center">Menu</h5>
        @if(auth()->user()->role == 'organizer')
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="/organizer/talents"><i class="fas fa-users"></i> Talents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/organizer/events"><i class="fas fa-calendar-alt"></i> Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/organizer/orders"><i class="fas fa-shopping-cart"></i> Orders</a>
                </li>
            </ul>
        @elseif(auth()->user()->role == 'owner')
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="/owner/organizers"><i class="fas fa-user-tie"></i> Organizers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/owner/events"><i class="fas fa-check-circle"></i> Approved Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/owner/orders"><i class="fas fa-shopping-cart"></i> Orders</a>
                </li>
            </ul>
        @elseif(auth()->user()->role == 'admin')
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/orders"><i class="fas fa-shopping-cart"></i> Orders</a>
                </li>
            </ul>
        @endif
    </div>
</aside>
