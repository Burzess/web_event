<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Exception;

class PaymentController extends Controller
{
    public function index()
    {
        try {
            $payments = Payment::with(['image', 'organizer'])->get();

            return response()->json([
                'message' => 'Data pembayaran berhasil diambil.',
                'data' => $payments,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data pembayaran.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'status' => 'required|boolean',
                'image_id' => 'nullable|exists:images,id',
                'organizer_id' => 'nullable|exists:organizers,id',
            ]);

            $payment = Payment::create($validated);

            return response()->json([
                'message' => 'Pembayaran berhasil dibuat.',
                'data' => $payment,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan validasi.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada database.',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat membuat pembayaran.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $payment = Payment::with(['image', 'organizer'])->findOrFail($id);

            return response()->json([
                'message' => 'Data pembayaran berhasil diambil.',
                'data' => $payment,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Pembayaran tidak ditemukan.',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data pembayaran.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $payment = Payment::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'status' => 'sometimes|boolean',
                'image_id' => 'nullable|exists:images,id',
                'organizer_id' => 'nullable|exists:organizers,id',
            ]);

            $payment->update($validated);

            return response()->json([
                'message' => 'Pembayaran berhasil diperbarui.',
                'data' => $payment,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Pembayaran tidak ditemukan.',
                'error' => $e->getMessage()
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan validasi.',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui pembayaran.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();

            return response()->json([
                'message' => 'Pembayaran berhasil dihapus.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Pembayaran tidak ditemukan.',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus pembayaran.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
