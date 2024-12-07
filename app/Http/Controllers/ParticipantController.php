<?php
namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::all();

        return response()->json([
            'message' => 'Data peserta berhasil diambil.',
            'data' => $participants
        ]);
    }

    public function store(Request $request)
    {
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

        return response()->json([
            'message' => 'Peserta berhasil dibuat.',
            'data' => $participant
        ], 201);
    }

    public function show($id)
    {
        $participant = Participant::findOrFail($id);

        return response()->json([
            'message' => 'Data peserta berhasil diambil.',
            'data' => $participant
        ]);
    }

    public function update(Request $request, $id)
    {
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

        return response()->json([
            'message' => 'Peserta berhasil diperbarui.',
            'data' => $participant
        ]);
    }

    public function destroy($id)
    {
        $participant = Participant::findOrFail($id);
        $participant->delete();

        return response()->json([
            'message' => 'Peserta berhasil dihapus.'
        ]);
    }
}
