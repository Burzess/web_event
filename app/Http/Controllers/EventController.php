<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Menampilkan semua event
    public function index()
    {
        $events = Event::with(['category', 'image', 'talent', 'organizer'])->get();
        return response()->json($events);
    }

    // Menampilkan event berdasarkan ID
    public function show($id)
    {
        $event = Event::with(['category', 'image', 'talent', 'organizer'])->findOrFail($id);
        return response()->json($event);
    }

    // Menyimpan event baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'about' => 'required|string',
            'status' => 'required|in:active,inactive',
            'categories' => 'nullable|exists:categories,id',
            'image' => 'nullable|exists:images,id',
            'talent' => 'nullable|exists:talents,id',
            'organizer' => 'nullable|exists:organizers,id',
        ]);

        $event = Event::create($request->all());
        return response()->json($event, 201);
    }

    // Memperbarui event berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'about' => 'required|string',
            'status' => 'required|in:active,inactive',
            'categories' => 'nullable|exists:categories,id',
            'image' => 'nullable|exists:images,id',
            'talent' => 'nullable|exists:talents,id',
            'organizer' => 'nullable|exists:organizers,id',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());
        return response()->json($event);
    }

    // Menghapus event berdasarkan ID
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
