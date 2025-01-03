<?php

namespace App\Http\Controllers\Controllersview;

use App\Http\Controllers\Controller;
use App\Models\TicketCategory;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class TicketCategoryController extends Controller
{

    public function index(Request $request)
    {
        try {
            $ticketCategories = TicketCategory::with('event')->get();
            return view('ticket_categories.index', compact('ticketCategories'));
        } catch (Exception $e) {
            return view('error', ['message' => 'An error occurred while fetching ticket categories.']);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'price' => 'required|integer|min:0|unique:ticket_categories,price',
                'stock' => 'required|integer|min:0',
                'sum_ticket' => 'required|integer|min:0',
                'status' => 'required|in:available,sold out',
                'event_id' => 'nullable|exists:events,id',
            ]);

            $ticketCategory = TicketCategory::create($validated);

            return redirect()->route('ticket_categories.index')->with('success', 'Ticket category created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the ticket category.')->withInput();
        }
    }

    public function show($id)
    {
        try {
            $ticketCategory = TicketCategory::with('event')->findOrFail($id);
            return view('ticket_categories.show', compact('ticketCategory'));
        } catch (ModelNotFoundException $e) {
            return view('error', ['message' => 'Ticket category not found.']);
        } catch (Exception $e) {
            return view('error', ['message' => 'An error occurred while fetching the ticket category.']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ticketCategory = TicketCategory::findOrFail($id);

            $validated = $request->validate([
                'price' => 'required|integer|min:0|unique:ticket_categories,price,' . $ticketCategory->id,
                'stock' => 'required|integer|min:0',
                'sum_ticket' => 'required|integer|min:0',
                'status' => 'required|in:available,sold out',
                'event_id' => 'nullable|exists:events,id',
            ]);

            $ticketCategory->update($validated);

            return redirect()->route('ticket_categories.show', $ticketCategory->id)->with('success', 'Ticket category updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('ticket_categories.index')->with('error', 'Ticket category not found.');
        } catch (Exception $e) {
            return redirect()->route('ticket_categories.index')->with('error', 'An error occurred while updating the ticket category.');
        }
    }

    public function destroy($id)
    {
        try {
            $ticketCategory = TicketCategory::findOrFail($id);
            $ticketCategory->delete();

            return redirect()->route('ticket_categories.index')->with('success', 'Ticket category deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('ticket_categories.index')->with('error', 'Ticket category not found.');
        } catch (Exception $e) {
            return redirect()->route('ticket_categories.index')->with('error', 'An error occurred while deleting the ticket category.');
        }
    }
}
