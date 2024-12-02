<?php

namespace App\Http\Controllers;

use App\Models\TicketCategory;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    public function index()
    {
        $ticketCategories = TicketCategory::with('event')->get();

        if (request()->wantsJson()) {
            return response()->json($ticketCategories);
        }

        return view('ticket_categories.index', compact('ticketCategories'));
    }

    public function create()
    {
        $events = Event::all();
        return view('ticket_categories.create', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'sum_ticket' => 'required|integer|min:0',
            'status' => 'required|in:available,sold out',
            'event_id' => 'nullable|exists:events,id',
        ]);

        TicketCategory::create($validated);

        return redirect()->route('ticket_categories.index')->with('success', 'Ticket category created successfully.');
    }

    public function show($id)
    {
        $ticketCategory = TicketCategory::with('event')->findOrFail($id);

        if (request()->wantsJson()) {
            return response()->json($ticketCategory);
        }

        return view('ticket_categories.show', compact('ticketCategory'));
    }

    public function edit($id)
    {
        $ticketCategory = TicketCategory::findOrFail($id);
        $events = Event::all();

        return view('ticket_categories.edit', compact('ticketCategory', 'events'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'sum_ticket' => 'required|integer|min:0',
            'status' => 'required|in:available,sold out',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $ticketCategory = TicketCategory::findOrFail($id);
        $ticketCategory->update($validated);

        return redirect()->route('ticket_categories.index')->with('success', 'Ticket category updated successfully.');
    }

    public function destroy($id)
    {
        $ticketCategory = TicketCategory::findOrFail($id);
        $ticketCategory->delete();

        return redirect()->route('ticket_categories.index')->with('success', 'Ticket category deleted successfully.');
    }
}
