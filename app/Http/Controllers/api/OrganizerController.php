<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrganizerController extends Controller
{
    // Menampilkan semua organizers
    public function index(): JsonResponse
    {
        try {
            $organizers = Organizer::all();

            return response()->json([
                'success' => true,
                'data' => $organizers,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data organizer: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Menyimpan organizer baru
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:organizers,name',
            ]);

            $organizer = Organizer::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Organizer berhasil dibuat.',
                'data' => $organizer,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat organizer: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Menampilkan data organizer berdasarkan ID
    public function show($id): JsonResponse
    {
        try {
            $organizer = Organizer::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $organizer,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Organizer tidak ditemukan: ' . $e->getMessage(),
            ], 404);
        }
    }

    // Mengupdate organizer
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:organizers,name,' . $id,
            ]);

            $organizer = Organizer::findOrFail($id);
            $organizer->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Organizer berhasil diperbarui.',
                'data' => $organizer,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui organizer: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Menghapus organizer
    public function destroy($id): JsonResponse
    {
        try {
            $organizer = Organizer::findOrFail($id);
            $organizer->delete();

            return response()->json([
                'success' => true,
                'message' => 'Organizer berhasil dihapus.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus organizer: ' . $e->getMessage(),
            ], 500);
        }
    }
}
