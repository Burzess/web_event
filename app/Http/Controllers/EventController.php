<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Image;
use App\Models\Talent;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $events = Event::with(['category', 'image', 'talent', 'organizer'])->get();
            return response()->json(['success' => true, 'data' => $events], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mengambil acara.'], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $event = Event::with(['category', 'image', 'talent', 'organizer'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $event], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mengambil detail acara.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255|unique:events,title',
                'date' => 'required|date',
                'about' => 'required|string',
                'tagline' => 'nullable|string|max:255',
                'keypoint' => 'nullable|array',
                'venue_name' => 'required|string|max:255',
                'status' => 'required|in:active,inactive',
                'categories_id' => 'nullable|exists:categories,id',
                'image_id' => 'nullable|exists:images,id',
                'talent_id' => 'nullable|exists:talents,id',
                'organizer_id' => 'nullable|exists:organizers,id',
            ], [
                'title.required' => 'Judul acara harus diisi.',
                'title.unique' => 'Judul acara sudah digunakan.',
                'date.required' => 'Tanggal acara harus diisi.',
                'about.required' => 'Deskripsi acara harus diisi.',
                'venue_name.required' => 'Nama venue harus diisi.',
                'status.required' => 'Status acara harus dipilih.',
                'categories_id.exists' => 'Kategori tidak ditemukan.',
                'image_id.exists' => 'Gambar tidak ditemukan.',
                'talent_id.exists' => 'Talent tidak ditemukan.',
                'organizer_id.exists' => 'Organizer tidak ditemukan.',
            ]);

            $event = Event::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Acara berhasil dibuat.',
                'data' => $event,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal membuat acara. ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Event $event): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255|unique:events,title,' . $event->id,
                'date' => 'required|date',
                'about' => 'required|string',
                'tagline' => 'nullable|string|max:255',
                'keypoint' => 'nullable|array',
                'venue_name' => 'required|string|max:255',
                'status' => 'required|in:active,inactive',
                'categories_id' => 'nullable|exists:categories,id',
                'image_id' => 'nullable|exists:images,id',
                'talent_id' => 'nullable|exists:talents,id',
                'organizer_id' => 'nullable|exists:organizers,id',
            ], [
                'title.required' => 'Judul acara harus diisi.',
                'title.unique' => 'Judul acara sudah digunakan.',
                'date.required' => 'Tanggal acara harus diisi.',
                'about.required' => 'Deskripsi acara harus diisi.',
                'venue_name.required' => 'Nama venue harus diisi.',
                'status.required' => 'Status acara harus dipilih.',
                'categories_id.exists' => 'Kategori tidak ditemukan.',
                'image_id.exists' => 'Gambar tidak ditemukan.',
                'talent_id.exists' => 'Talent tidak ditemukan.',
                'organizer_id.exists' => 'Organizer tidak ditemukan.',
            ]);

            $event->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Acara berhasil diperbarui.',
                'data' => $event,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui acara. ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request, Event $event): JsonResponse
    {
        try {
            $event = Event::findOrFail($event->id);
            $event->delete();

            return response()->json([
                'success' => true,
                'message' => 'Acara berhasil dihapus.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus acara. ' . $e->getMessage()], 500);
        }
    }
}
