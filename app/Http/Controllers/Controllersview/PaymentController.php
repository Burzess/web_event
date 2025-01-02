<?php

namespace App\Http\Controllers\Controllersview;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class PaymentController extends Controller
{
    public function index()
    {
        try {
            $payments = Payment::with(['image', 'organizer'])->get();

            return view('payments.index', compact('payments'));
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat mengambil data pembayaran: ' . $e->getMessage()]);
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

            return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dibuat.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat membuat pembayaran: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $payment = Payment::with(['image', 'organizer'])->findOrFail($id);

            return view('payments.show', compact('payment'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return view('error', ['message' => 'Pembayaran tidak ditemukan: ' . $e->getMessage()]);
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat mengambil data pembayaran: ' . $e->getMessage()]);
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

            return redirect()->route('payments.show', $payment->id)->with('success', 'Pembayaran berhasil diperbarui.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return view('error', ['message' => 'Pembayaran tidak ditemukan: ' . $e->getMessage()]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat memperbarui pembayaran: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();

            return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return view('error', ['message' => 'Pembayaran tidak ditemukan: ' . $e->getMessage()]);
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat menghapus pembayaran: ' . $e->getMessage()]);
        }
    }
}
