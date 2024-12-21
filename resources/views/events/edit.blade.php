@extends('layouts.app')

@section('content')
    <h1>Edit Event</h1>
    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $event->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $event->date->format('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label for="about" class="form-label">About</label>
            <textarea class="form-control" id="about" name="about" required>{{ old('about', $event->about) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="tagline" class="form-label">Tagline</label>
            <input type="text" class="form-control" id="tagline" name="tagline" value="{{ old('tagline', $event->tagline) }}">
        </div>
        <div class="mb-3">
            <label for="venue_name" class="form-label">Venue Name</label>
            <input type="text" class="form-control" id="venue_name" name="venue_name" value="{{ old('venue_name', $event->venue_name) }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="active" {{ old('status', $event->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $event->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- Category Dropdown -->
        <div class="mb-3">
            <label for="categories_id" class="form-label">Category</label>
            <select class="form-select" id="categories_id" name="categories_id">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('categories_id', $event->categories_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Image Dropdown -->
        <div class="mb-3">
            <label for="image_id" class="form-label">Image</label>
            <select class="form-select" id="image_id" name="image_id">
                <option value="">Select Image</option>
                @foreach ($images as $image)
                    <option value="{{ $image->id }}" {{ old('image_id', $event->image_id) == $image->id ? 'selected' : '' }}>
                        {{ $image->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Talent Dropdown -->
        <div class="mb-3">
            <label for="talent_id" class="form-label">Talent</label>
            <select class="form-select" id="talent_id" name="talent_id">
                <option value="">Select Talent</option>
                @foreach ($talents as $talent)
                    <option value="{{ $talent->id }}" {{ old('talent_id', $event->talent_id) == $talent->id ? 'selected' : '' }}>
                        {{ $talent->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Organizer Dropdown -->
        <div class="mb-3">
            <label for="organizer_id" class="form-label">Organizer</label>
            <select class="form-select" id="organizer_id" name="organizer_id">
                <option value="">Select Organizer</option>
                @foreach ($organizers as $organizer)
                    <option value="{{ $organizer->id }}" {{ old('organizer_id', $event->organizer_id) == $organizer->id ? 'selected' : '' }}>
                        {{ $organizer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
@endsection
