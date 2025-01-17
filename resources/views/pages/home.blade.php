@extends('pages.app')

@section('content')
    <header class="header bg-navy">

        <div class="hero">
            <div class="hero-headline">
                Expand Your <span class="text-gradient-blue">Knowledge</span> <br class="d-none d-lg-block" />
                by <span class="text-gradient-pink">Joining</span> Our Greatest Events
            </div>
            <p class="hero-paragraph">
                Kami menyediakan berbagai acara terbaik untuk membantu <br class="d-none d-lg-block" />
                anda dalam meningkatkan skills di bidang teknologi
            </p>
            <a href="#grow-today" class="btn-green">
                Browse Now
            </a>
        </div>

        <div class="d-flex flex-row flex-nowrap justify-content-center align-items-center gap-5 header-image">
            <img src="assets/images/1.png" alt="semina"/ class="img-1">
            <img src="assets/images/2.png" alt="semina"/ class="img-2">
            <img src="assets/images/1.png" alt="semina"/ class="img-1">
        </div>
    </header>

    <section class="brand-partner text-center">
        <p>Events held by top & biggest global companies</p>
        <div class="d-flex flex-row flex-wrap justify-content-center align-items-center">
            <img src="assets/images/apple-111.svg" alt="semina" />
            <img src="assets/images/Adobe.svg" alt="semina" />
            <img src="assets/images/slack-21.svg" alt="semina" />
            <img src="assets/images/spotify-11.svg" alt="semina" />
            <img src="assets/images/google-2015.svg" alt="semina" />
        </div>
    </section>

    <section class="grow-today">
        <div class="container">
            <div class="sub-title mb-1" id="grow-today">
                <span class="text-gradient-pink">Grow Today</span>
            </div>
            <div class="title">
                Featured Events
            </div>
            <div class="mt-5 row gap">
                @foreach ($events as $event)
                    <!-- CARD -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card-grow h-100">
                            <span class="badge-pricing">
                                {{ $event->ticketCategories->isNotEmpty() && $event->ticketCategories->first()->price != null
                                    ? ($event->ticketCategories->first()->price == 0
                                        ? 'Free'
                                        : 'Rp. ' . number_format($event->ticketCategories->first()->price, 0, ',', '.'))
                                    : 'Free' }}
                            </span>
                            @if ($event->image)
                                <img src="{{ asset('storage/' . $event->image->file_path) }}" alt="semina" />
                            @else
                                <img src="{{ asset('assets/images/default-image.jpg') }}" alt="default" />
                            @endif
                            <div class="card-content">
                                <div class="card-title">
                                    {{ $event->title }}
                                </div>
                                <div class="card-subtitle">
                                    {{ $event->category }}
                                </div>
                                <div class="description">
                                    {{ $event->venue_name }}, {{ $event->date->format('d M Y') }}
                                </div>
                                @if(isset($event) && $event->id)
                                    <a href="{{ route('event.detail', $event) }}" class="stretched-link"></a>
                                @else
                                    <span>Event tidak tersedia.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- <section class="stories">
        <div class="d-flex flex-row justify-content-center align-items-center container">
            <img src="assets/images/story.png" alt="semina" class="d-none d-lg-block" width="515" />
            <div class="d-flex flex-column">
                <div>
                    <div class="sub-title">
                        <span class="text-gradient-pink">Story</span>
                    </div>
                    <div class="title">
                        One Great Event. <br class="d-none d-lg-block" />
                        For The Better World.
                    </div>
                </div>
                <p class="paragraph">
                    Baca kisah bagaimana Shayna berhasil membangun <br class="d-none d-lg-block" />
                    sebuah Startup yang membantu warga untuk <br class="d-none d-lg-block" />
                    mendapatkan bantuan selama pandemic.
                </p>
                <a href="#" class="btn-navy">Read</a>
            </div>
        </div>
    </section> --}}

    <section class="statistics container">
        <div class="d-flex flex-row flex-wrap justify-content-center align-items-center gap-5">
            <div class="d-flex flex-column align-items-center gap-1">
                <div class="title">
                    {{ $totalEvents }}K+
                </div>
                <p>
                    Events Created
                </p>
            </div>
            <div class="vr"></div>
            <div class="d-flex flex-column align-items-center gap-1">
                <div class="title">
                    {{ $totalParticipants }}M
                </div>
                <p>
                    People Joined
                </p>
            </div>
            <div class="vr d-none d-md-block"></div>
            <div class="d-flex flex-column align-items-center gap-1">
                <div class="title">
                    5K+
                </div>
                <p>
                    Success Startup
                </p>
            </div>
            <div class="vr"></div>
            <div class="d-flex flex-column align-items-center gap-1">
                <div class="title">
                    {{ $totalTalents }}K+
                </div>
                <p>
                    Top Speakers
                </p>
            </div>
        </div>
    </section>

    <x-footer />
    {{-- <footer class="footer bg-navy">
        <div class="container">
            <a href="index.html">
                <img src="assets/images/logo.svg" alt="semina" />
            </a>
            <div class="mt-3 d-flex flex-row flex-wrap footer-content align-items-baseline">
                <p class="paragraph">
                    Semina adalah tempat di mana <br class="d-md-block d-none" /> anda dapat mencari event sesuai <br
                        class="d-md-block d-none" /> dengan minat & terdekat.
                </p>
                <div class="d-flex flex-column footer-links">
                    <div class="title-links mb-3">Features</div>
                    <a href="#">Virtual</a>
                    <a href="#">Pricing</a>
                    <a href="#">Merchant</a>
                    <a href="#">Tickets</a>
                </div>
                <div class="d-flex flex-column footer-links">
                    <div class="title-links mb-3">Company</div>
                    <a href="#">Jobs</a>
                    <a href="#">API</a>
                    <a href="#">Press</a>
                    <a href="#">Sitemap</a>
                </div>
                <div class="d-flex flex-column footer-links">
                    <div class="title-links mb-3">Learn</div>
                    <a href="#">Guidebook</a>
                    <a href="#">Inspiration</a>
                    <a href="#">Community</a>
                    <a href="#">Tools</a>
                </div>
            </div>
            <div class="d-flex justify-content-center paragraph all-rights">
                All Rights Reserved. Semina Angga 2022.
            </div>
        </div>
    </footer> --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

@endsection
