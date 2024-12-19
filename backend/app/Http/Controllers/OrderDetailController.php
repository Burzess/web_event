<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Exception;

class OrderDetailController extends Controller
{
    public function index()
    {
        try {
            $orderDetails = OrderDetail::with('order')->get();

            return response()->json([
                'message' => 'Detail pesanan berhasil diambil.',
                'data' => $orderDetails,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil detail pesanan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'history_ticket_categories' => 'required|array',
                'sum_ticket' => 'required|integer',
                'order_id' => 'nullable|exists:orders,id',
            ]);

            $orderDetail = OrderDetail::create([
                'history_ticket_categories' => $validated['history_ticket_categories'],
                'sum_ticket' => $validated['sum_ticket'],
                'order_id' => $validated['order_id'] ?? null,
            ]);

            return response()->json([
                'message' => 'Detail pesanan berhasil dibuat.',
                'data' => $orderDetail,
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database query exceptions
            return response()->json([
                'message' => 'Terjadi kesalahan pada database.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions
            return response()->json([
                'message' => 'Terjadi kesalahan validasi.',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'Terjadi kesalahan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $orderDetail = OrderDetail::with('order')->findOrFail($id);

            return response()->json([
                'message' => 'Detail pesanan berhasil diambil.',
                'data' => $orderDetail,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Detail pesanan tidak ditemukan.',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil detail pesanan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $orderDetail = OrderDetail::findOrFail($id);

            $validated = $request->validate([
                'history_ticket_categories' => 'sometimes|array',
                'sum_ticket' => 'sometimes|integer',
                'order_id' => 'nullable|exists:orders,id',
            ]);

            $orderDetail->update($validated);

            return response()->json([
                'message' => 'Detail pesanan berhasil diperbarui.',
                'data' => $orderDetail,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Detail pesanan tidak ditemukan.',
                'error' => $e->getMessage()
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan validasi.',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui detail pesanan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $orderDetail = OrderDetail::findOrFail($id);
            $orderDetail->delete();

            return response()->json([
                'message' => 'Detail pesanan berhasil dihapus.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Detail pesanan tidak ditemukan.',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus detail pesanan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
