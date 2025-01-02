<?php
namespace App\Http\Controllers\Controllersview;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Participant;
use App\Models\Event;
use Illuminate\Http\Request;
use Exception;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders = Order::with(['participant', 'event'])->get(); // Eager loading untuk efisiensi
            return view('orders.index', ['orders' => $orders]);
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat mengambil data pesanan: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        try {
            $participants = Participant::all(); // Mengambil data peserta
            $events = Event::all(); // Mengambil data acara
            return view('orders.create', compact('participants', 'events'));
        } catch (Exception $e) {
            return view('error', ['message' => 'Gagal memuat form pembuatan pesanan: ' . $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'date' => 'required|date',
                'status' => 'required|string|in:pending,completed,cancelled',
                'total_pay' => 'required|integer|min:0',
                'total_order_ticket' => 'required|integer|min:1',
                'participant_id' => 'required|exists:participants,id',
                'event_id' => 'required|exists:events,id',
                'personalDetail' => 'nullable|array',
            ]);

            $order = Order::create($validated);

            return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat membuat pesanan: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $order = Order::with(['participant', 'event'])->findOrFail($id);
            return view('orders.show', ['order' => $order]);
        } catch (Exception $e) {
            return view('error', ['message' => 'Pesanan tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $order = Order::findOrFail($id);
            $participants = Participant::all();
            $events = Event::all();
            return view('orders.edit', compact('order', 'participants', 'events'));
        } catch (Exception $e) {
            return view('error', ['message' => 'Pesanan tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);

            $validated = $request->validate([
                'date' => 'sometimes|date',
                'status' => 'sometimes|string|in:pending,completed,cancelled',
                'total_pay' => 'sometimes|integer|min:0',
                'total_order_ticket' => 'sometimes|integer|min:1',
                'participant_id' => 'sometimes|exists:participants,id',
                'event_id' => 'sometimes|exists:events,id',
                'personalDetail' => 'nullable|array',
            ]);

            $order->update($validated);

            return redirect()->route('orders.show', $order->id)->with('success', 'Pesanan berhasil diperbarui.');
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat memperbarui pesanan: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat menghapus pesanan: ' . $e->getMessage()]);
        }
    }
}
