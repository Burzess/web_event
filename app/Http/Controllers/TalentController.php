<?php
namespace App\Http\Controllers;

use App\Models\Talent;
use App\Models\Organizer;
use App\Models\Image;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TalentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $talents = Talent::with(['organizer', 'image', 'role'])->get();
            return response()->json(['success' => true, 'data' => $talents], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data talent: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $talent = Talent::with(['organizer', 'image', 'role'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $talent], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data talent: ' . $e->getMessage(),
            ], 500);
        }
    }

    // public function show(Request $request, $id): JsonResponse
    // {
    //     try {
    //         $talent = Talent::with(['organizer', 'image', 'role'])->findOrFail($id);
    //         return response()->json(['success' => true, 'data' => $talent], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal mengambil data talent: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:talents,name',
                'organizer_id' => 'nullable|exists:organizers,id',
                'image_id' => 'nullable|exists:images,id',
                'role_id' => 'nullable|exists:roles,id',
            ], [
                'name.required' => 'Nama talent harus diisi.',
                'name.unique' => 'Nama talent sudah digunakan.',
                'organizer_id.exists' => 'Organizer tidak ditemukan.',
                'image_id.exists' => 'Gambar tidak ditemukan.',
                'role_id.exists' => 'Role tidak ditemukan.',
            ]);

            $talent = Talent::create([
                'name' => $request->input('name'),
                'organizer_id' => $request->input('organizer_id'),
                'image_id' => $request->input('image_id'),
                'role_id' => $request->input('role_id'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Talent berhasil ditambahkan.',
                'data' => $talent,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan talent: ' . $e->getMessage(),
            ], 500);
        }
    }

//     public function edit(Request $request, $id): JsonResponse
// {
//     try {
//         // Mencari talent berdasarkan ID
//         $talent = Talent::with(['organizer', 'image', 'role'])->findOrFail($id);

//         // Mengembalikan data talent dalam format JSON
//         return response()->json([
//             'success' => true,
//             'data' => $talent
//         ], 200);
//     } catch (\Exception $e) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Gagal memuat data talent: ' . $e->getMessage(),
//         ], 500);
//     }
// }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:talents,name,' . $id,
                'organizer_id' => 'nullable|exists:organizers,id',
                'image_id' => 'nullable|exists:images,id',
                'role_id' => 'nullable|exists:roles,id',
            ], [
                'name.required' => 'Nama talent harus diisi.',
                'name.unique' => 'Nama talent sudah digunakan.',
                'organizer_id.exists' => 'Organizer tidak ditemukan.',
                'image_id.exists' => 'Gambar tidak ditemukan.',
                'role_id.exists' => 'Role tidak ditemukan.',
            ]);

            $talent = Talent::findOrFail($id);
            $talent->update([
                'name' => $request->input('name'),
                'organizer_id' => $request->input('organizer_id'),
                'image_id' => $request->input('image_id'),
                'role_id' => $request->input('role_id'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Talent berhasil diperbarui.',
                'data' => $talent,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui talent: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $talent = Talent::findOrFail($id);
            $talent->delete();

            return response()->json([
                'success' => true,
                'message' => 'Talent berhasil dihapus.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus talent: ' . $e->getMessage(),
            ], 500);
        }
    }
}
