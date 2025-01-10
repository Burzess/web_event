@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-2">
        @include('components.sidebar')
    </div>
    <div class="col-md-10">
        <div class="content-wrapper p-4">
            @yield('organizer-content')
        </div>
    </div>
</div>
@endsection
