@extends('pages.app')

@section('content')
    <div class="preview-image bg-navy text-center">
        @if ($event->image)
            <img src="{{ asset('storage/' . $event->image->file_path) }}" alt="semina" class="img-content" />
        @else
            <img src="{{ asset('assets/images/default-image.jpg') }}" alt="default" class="img-content" />
        @endif
    </div>

    <div class="details-content container">
        <div class="d-flex flex-wrap justify-content-lg-center gap">
            <!-- Left Side Description -->
            <div class="d-flex flex-column description">
                <div class="headline">
                    {{ $event->title }}
                </div>
                <div class="event-details">
                    <h6>Event Details</h6>
                    <p class="details-paragraph">
                        {{ $event->about }}
                    </p>
                </div>
                <div class="keypoints">
                    @if ($event->keypoints)
                        @foreach (json_decode($event->keypoints, true) as $keypoint)
                            <div class="d-flex align-items-start gap-3">
                                <img src="assets/icons/ic-check.svg" alt="semina">
                                <span>{{ $keypoint }}</span>
                            </div>
                        @endforeach
                    @else
                        <p></p>
                    @endif
                </div>
                <div class="map-location">
                    <h6>Event Location</h6>
                    <div class="map-placeholder">
                        <div class="maps">
                            <img src="assets/images/maps.png" alt="">
                            <div class="absolute d-flex justify-content-center align-items-center" id="hoverMe">
                                <a href="#" class="btn-navy" id="btn-maps">
                                    View in Google Maps
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Event -->
            <div class="d-flex flex-column card-event">
                <!-- Speaker Information -->
                <h6>Your Speaker</h6>
                <div class="d-flex align-items-center gap-3 mt-3">
                    @if ($event->talent)
                        @if ($event->talent->image)
                            <img src="{{ asset('storage/' . $event->talent->image->file_path) }}" alt="semina"
                                width="60">
                        @else
                            <img src="assets/images/default-image.jpg" alt="default" width="60">
                        @endif
                        <div>
                            <div class="speaker-name">
                                {{ $event->talent->name }}
                            </div>
                            <span class="occupation">{{ $event->talent->occupation }}</span>
                        </div>
                    @else
                        <img src="assets/images/default-image.jpg" alt="default" width="60">
                        <div>
                            <div class="speaker-name">Tidak ada informasi pembicara.</div>
                            <span class="occupation">N/A</span>
                        </div>
                    @endif
                </div>
                <hr>
                <!-- Ticket Information -->
                <h6>Get Ticket</h6>
                @foreach ($event->ticketCategories as $ticketCategory)
                    <div class="price my-3">{{ $ticketCategory->price }}<span>/person</span></div>
                @endforeach
                <div class="d-flex gap-3 align-items-center card-details">
                    <img src="../assets/icons/ic-marker.svg" alt="semina"> {{ $event->venue_name }}
                </div>
                <div class="d-flex gap-3 align-items-center card-details">
                    <img src="../assets/icons/ic-time.svg" alt="semina">
                    {{ \Carbon\Carbon::parse($event->date)->format('H:i') }} WIB
                </div>
                <div class="d-flex gap-3 align-items-center card-details">
                    <img src="../assets/icons/ic-calendar.svg" alt="semina">
                    {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}
                </div>
                <a href="checkout.html" class="btn-green">Join Now</a>
            </div>
        </div>
    </div>

    <section class="grow-today">
        <div class="container">
            <div class="sub-title mb-1">
                <span class="text-gradient-pink">Next One</span>
            </div>
            <div class="title">
                Similiar Events
            </div>
            <div class="mt-5 row gap">
                @foreach ($similarEvents as $event)
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
                                <img src="assets/images/default-image.jpg" alt="default" />
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
                                @if (isset($event) && $event->id)
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

    <section class="stories">
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
    </section>

    <section class="statistics container">
        <div class="d-flex flex-row flex-wrap justify-content-center align-items-center gap-5">
            <div class="d-flex flex-column align-items-center gap-1">
                <div class="title">
                    190K+
                </div>
                <p>
                    Events Created
                </p>
            </div>
            <div class="vr"></div>
            <div class="d-flex flex-column align-items-center gap-1">
                <div class="title">
                    3M
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
                    113K+
                </div>
                <p>
                    Top Speakers
                </p>
            </div>
        </div>
    </section>

    <footer class="footer bg-navy">
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
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

    <script>
        document.getElementById("hoverMe").addEventListener("mouseover", mouseOver);
        document.getElementById("hoverMe").addEventListener("mouseout", mouseOut);

        function mouseOver() {
            document.getElementById("btn-maps").style.opacity = "100"
            document.getElementById("hoverMe").style.backgroundColor = "#151a2638"
        }

        function mouseOut() {
            document.getElementById("btn-maps").style.opacity = "0"
            document.getElementById("hoverMe").style.backgroundColor = "transparent"
        }
    </script>

@endsection
