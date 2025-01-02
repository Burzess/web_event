<?php

namespace App\Http\Controllers\Controllersview;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;

class ParticipantController extends Controller
{
    public function index()
    {
        try {
            $participants = Participant::all();
            return view('participants.index', ['participants' => $participants]);
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat mengambil data peserta: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        try {
            return view('participants.create');
        } catch (Exception $e) {
            return view('error', ['message' => 'Gagal memuat form pembuatan peserta: ' . $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:participants',
                'password' => 'required|string|min:3',
                'status' => 'nullable|string|max:255',
                'active_code' => 'nullable|string|max:255',
            ]);

            $participant = Participant::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'status' => $validated['status'],
                'active_code' => $validated['active_code'],
            ]);

            return redirect()->route('participants.index')->with('success', 'Peserta berhasil dibuat.');
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat membuat peserta: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $participant = Participant::findOrFail($id);
            return view('participants.show', ['participant' => $participant]);
        } catch (Exception $e) {
            return view('error', ['message' => 'Peserta tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $participant = Participant::findOrFail($id);
            return view('participants.edit', ['participant' => $participant]);
        } catch (Exception $e) {
            return view('error', ['message' => 'Peserta tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $participant = Participant::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:participants,email,' . $id,
                'password' => 'sometimes|string|min:3',
                'status' => 'sometimes|string|max:255',
                'active_code' => 'sometimes|string|max:255',
            ]);

            if (isset($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            }

            $participant->update($validated);

            return redirect()->route('participants.show', $participant->id)->with('success', 'Peserta berhasil diperbarui.');
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat memperbarui peserta: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $participant = Participant::findOrFail($id);
            $participant->delete();

            return redirect()->route('participants.index')->with('success', 'Peserta berhasil dihapus.');
        } catch (Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat menghapus peserta: ' . $e->getMessage()]);
        }
    }
}
