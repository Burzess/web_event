<?php

namespace App\Http\Controllers\Controllersview;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Exception;

class OrderDetailController extends Controller
{
    public function index()
    {
        try {
            $orderDetails = OrderDetail::with('order')->get();

            return view('order_details.index', compact('orderDetails'));
        } catch (Exception $e) {
            return view('errors.general', [
                'message' => 'Terjadi kesalahan saat mengambil detail pesanan.',
                'error' => $e->getMessage(),
            ]);
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

            return redirect()->route('order_details.index')->with('success', 'Detail pesanan berhasil dibuat.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $orderDetail = OrderDetail::with('order')->findOrFail($id);

            return view('order_details.show', compact('orderDetail'));
        } catch (Exception $e) {
            return view('errors.general', [
                'message' => 'Terjadi kesalahan saat mengambil detail pesanan.',
                'error' => $e->getMessage(),
            ]);
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

            return redirect()->route('order_details.index')->with('success', 'Detail pesanan berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $orderDetail = OrderDetail::findOrFail($id);
            $orderDetail->delete();

            return redirect()->route('order_details.index')->with('success', 'Detail pesanan berhasil dihapus.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
