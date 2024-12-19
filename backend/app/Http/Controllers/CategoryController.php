<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index(Request $request): JsonResponse
    {
        try {
            $categories = Category::with('organizer')->get();

            return response()->json([
                'success' => true,
                'data' => $categories,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kategori: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Menyimpan kategori baru
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'organizer_id' => 'nullable|exists:organizers,id',
            ], [
                'name.required' => 'Nama kategori harus diisi.',
                'name.unique' => 'Nama kategori sudah digunakan.',
                'organizer_id.required' => 'Organizer harus dipilih.',
                'organizer_id.exists' => 'Organizer yang dipilih tidak valid.',
            ]);

            $category = Category::create([
                'name' => $request->input('name'),
                'organizer_id' => $request->input('organizer_id'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil ditambahkan.',
                'data' => $category,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan kategori: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Menampilkan detail kategori berdasarkan ID
    // public function show(Request $request, $id): JsonResponse
    // {
    //     try {
    //         $category = Category::with('organizer')->findOrFail($id);

    //         return response()->json([
    //             'success' => true,
    //             'data' => $category,
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Kategori tidak ditemukan: ' . $e->getMessage(),
    //         ], 404);
    //     }
    // }

    public function show($id): JsonResponse
    {
        try {
            $category = Category::with('organizer')->findOrFail($id);
            return response()->json(['success' => true, 'data' => $category], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Kategori not found: ' . $e->getMessage()], 404);
        }
    }

    // Mengupdate kategori
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $id,
                'organizer_id' => 'nullable|exists:organizers,id',
            ], [
                'name.required' => 'Nama kategori harus diisi.',
                'name.unique' => 'Nama kategori sudah digunakan.',
                // 'organizer_id.required' => 'Organizer harus dipilih.',
                'organizer_id.exists' => 'Organizer yang dipilih tidak valid.',
            ]);

            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->input('name'),
                'organizer_id' => $request->input('organizer_id'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil diubah.',
                'data' => $category,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah kategori: ' . $e->getMessage(),
            ], 500);
        }
    }




    // Menghapus kategori berdasarkan ID
    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dihapus.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kategori: ' . $e->getMessage(),
            ], 500);
        }
    }
}
