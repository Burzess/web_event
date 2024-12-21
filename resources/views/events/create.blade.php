@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Create New Event</h1>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="mb-3">
            <label for="about" class="form-label">About</label>
            <textarea class="form-control" id="about" name="about" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="tagline" class="form-label">Tagline</label>
            <input type="text" class="form-control" id="tagline" name="tagline">
        </div>
        <div class="mb-3">
            <label for="venue_name" class="form-label">Venue Name</label>
            <input type="text" class="form-control" id="venue_name" name="venue_name" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="categories_id" class="form-label">Category</label>
            <select class="form-select" id="categories_id" name="categories_id">
                <option value="">-- Select a Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image_id" class="form-label">Image</label>
            <select class="form-select" id="image_id" name="image_id">
                <option value="">-- Select an Image --</option>
                @foreach ($images as $image)
                    <option value="{{ $image->id }}">{{ $image->url }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="talent_id" class="form-label">Talent</label>
            <select class="form-select" id="talent_id" name="talent_id">
                <option value="">-- Select a Talent --</option>
                @foreach ($talents as $talent)
                    <option value="{{ $talent->id }}">{{ $talent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="organizer_id" class="form-label">Organizer</label>
            <select class="form-select" id="organizer_id" name="organizer_id">
                <option value="">-- Select an Organizer --</option>
                @foreach ($organizers as $organizer)
                    <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Create Event</button>
    </form>
@endsection
