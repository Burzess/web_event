<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($breadcrumbs as $breadcrumb)
            <li class="breadcrumb-item">
                <a href="{{ $breadcrumb['url'] }}"><i class="fas fa-chevron-right"></i> {{ $breadcrumb['label'] }}</a>
            </li>
        @endforeach
    </ol>
</nav>
