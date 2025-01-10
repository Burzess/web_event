<?php

namespace App\Http\Controllers;

use App\Models\TicketCategory;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TicketCategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $ticketCategories = TicketCategory::with('event', 'event.categories', 'event.image', 'event.talent', 'event.organizer')->get();

            return response()->json([
                'success' => true,
                'data' => $ticketCategories,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching ticket categories.',
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
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

            return response()->json([
                'success' => true,
                'message' => 'Ticket category created successfully.',
                'data' => $ticketCategory,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the ticket category.',
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $ticketCategory = TicketCategory::with('event')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $ticketCategory,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket category not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching the ticket category.',
            ], 500);
        }
    }


    public function update(Request $request, $id): JsonResponse
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

            return response()->json([
                'success' => true,
                'message' => 'Ticket category updated successfully.',
                'data' => $ticketCategory,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket category not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the ticket category.',
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $ticketCategory = TicketCategory::findOrFail($id);
            $ticketCategory->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ticket category deleted successfully.',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket category not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the ticket category.',
            ], 500);
        }
    }
}
