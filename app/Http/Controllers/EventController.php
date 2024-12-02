<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Image;
use App\Models\Talent;
use App\Models\Organizer;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['category', 'image', 'talent', 'organizer'])->get();
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load(['category', 'image', 'talent', 'organizer']);
        return view('events.show', compact('event'));
    }

    public function create()
    {
        $categories = Category::all();
        $images = Image::all();
        $talents = Talent::all();
        $organizers = Organizer::all();

        return view('events.create', compact('categories', 'images', 'talents', 'organizers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'about' => 'required|string',
            'tagline' => 'nullable|string|max:255',
            'keypoint' => 'nullable|array',
            'venue_name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'categories_id' => 'nullable|exists:categories,id',
            'image_id' => 'nullable|exists:images,id',
            'talent_id' => 'nullable|exists:talents,id',
            'organizer_id' => 'nullable|exists:organizers,id',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        $categories = Category::all();
        $images = Image::all();
        $talents = Talent::all();
        $organizers = Organizer::all();

        return view('events.edit', compact('event', 'categories', 'images', 'talents', 'organizers'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'about' => 'required|string',
            'tagline' => 'nullable|string|max:255',
            'keypoint' => 'nullable|array',
            'venue_name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'categories_id' => 'nullable|exists:categories,id',
            'image_id' => 'nullable|exists:images,id',
            'talent_id' => 'nullable|exists:talents,id',
            'organizer_id' => 'nullable|exists:organizers,id',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
