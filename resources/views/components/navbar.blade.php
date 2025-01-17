<!-- START: NAVBAR -->
<section class="bg-navy">
    <nav class="container navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/logo.svg" alt="semina" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto my-3 my-lg-0">
                    <x-nav-link class="nav-link" href="index.html" :active="request()->routeIs('home')">Home</x-nav-link>
                    <x-nav-link class="nav-link" href="#">Browse</x-nav-link>
                    <x-nav-link class="nav-link" href="#">Stories</x-nav-link>
                    <x-nav-link class="nav-link" href="#">About</x-nav-link>
                </div>
                <div class="navbar-nav ms-auto">
                    <div
                        class="nav-item dropdown d-flex flex-column flex-lg-row align-items-lg-center authenticated gap-3">
                        <span class="text-light d-none d-lg-block">Hello, Shayna M</span>

                        <!-- START: Dropdown Toggler for Desktop -->
                        <div x-data="{ open: false }">
                            <a class="nav-link dropdown-toggle mx-0 d-none d-lg-block" href="#" @click="open = !open">
                                <img src="assets/images/avatar.png" alt="semina" width="60" />
                            </a>
                            <div x-show="open" @click.away="open = false">
                                <x-dropdown-link href="#">Dashboard</x-dropdown-link>
                                <x-dropdown-link href="#">Settings</x-dropdown-link>
                                <x-dropdown-link href="#">Rewards</x-dropdown-link>
                                <x-dropdown-link href="signin.html">Sign Out</x-dropdown-link>
                            </div>
                        </div>
                        <!-- END: Dropdown Toggler for Desktop -->

                        <!-- START: Dropdown Toggler for Mobile -->
                        <a class="d-block d-lg-none dropdown-toggle text-light text-decoration-none"
                            data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            <img src="assets/images/avatar.png" alt="semina" width="60" />
                        </a>
                        <!-- END: Dropdown Toggler for Mobile -->

                        <!-- START: Dropdown Menu for Mobile -->
                        <div class="collapse" id="collapseExample">
                            <ul class="list-group">
                                <li>
                                    <a class="list-group-item" href="#">Dashboard</a>
                                </li>
                                <li>
                                    <a class="list-group-item" href="#">Settings</a>
                                </li>
                                <li>
                                    <a class="list-group-item" href="#">Rewards</a>
                                </li>
                                <li>
                                    <a class="list-group-item" href="signin.html">Sign Out</a>
                                </li>
                            </ul>
                        </div>
                        <!-- END: Dropdown Menu for Mobile -->
                    </div>
                </div>
            </div>
        </div>
    </nav>
</section>
<!-- END: NAVBAR -->