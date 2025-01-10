<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $orders = Order::all();
            return response()->json([
                'message' => 'Data pesanan berhasil diambil.',
                'data' => $orders
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data pesanan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'date' => 'required|date',
                'status' => 'required|string|max:255',
                'total_pay' => 'required|integer',
                'total_order_ticket' => 'required|integer',
                'participant_id' => 'required|exists:participants,id',
                'event_id' => 'required|exists:events,id',
                'personalDetail' => 'nullable|array',
            ]);

            $order = Order::create($validated);

            return response()->json([
                'message' => 'Pesanan berhasil dibuat.',
                'data' => $order
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat membuat pesanan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $order = Order::findOrFail($id);
            return response()->json([
                'message' => 'Detail pesanan berhasil diambil.',
                'data' => $order
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Pesanan tidak ditemukan.',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $order = Order::findOrFail($id);

            $validated = $request->validate([
                'date' => 'sometimes|date',
                'status' => 'sometimes|string|max:255',
                'total_pay' => 'sometimes|integer',
                'total_order_ticket' => 'sometimes|integer',
                'participant_id' => 'sometimes|exists:participants,id',
                'event_id' => 'sometimes|exists:events,id',
                'personalDetail' => 'nullable|array',
            ]);

            $order->update($validated);

            return response()->json([
                'message' => 'Pesanan berhasil diperbarui.',
                'data' => $order
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui pesanan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return response()->json([
                'message' => 'Pesanan berhasil dihapus.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus pesanan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
