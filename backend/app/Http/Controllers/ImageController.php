<?php
namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    // Menampilkan semua gambar
    public function index(Request $request): JsonResponse
    {
        try {
            $images = Image::all();
            return response()->json(['success' => true, 'data' => $images], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data gambar: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Menyimpan gambar baru
    // public function store(Request $request): JsonResponse
    // {
    //     try {
    //         $request->validate([
    //             'name' => 'required|string|max:255|unique:images,name',
    //             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:80000',
    //         ], [
    //             'name.required' => 'Nama gambar harus diisi.',
    //             'name.unique' => 'Nama gambar sudah digunakan.',
    //             'image.required' => 'File gambar harus diunggah.',
    //             'image.image' => 'File harus berupa gambar.',
    //             'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
    //             'image.max' => 'Ukuran file gambar maksimal 80MB.',
    //         ]);

    //         $filePath = $request->file('image')->store('uploads', 'public');

    //         $image = Image::create([
    //             'name' => $request->name,
    //             'file_path' => $filePath,
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Gambar berhasil ditambahkan.',
    //             'data' => $image,
    //         ], 201);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal menambahkan gambar: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function store(Request $request): JsonResponse
    {
        \Log::info($request);
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('image');
            $originalName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads', $originalName, 'public');

            $newImage = new Image();
            $newImage->name = $originalName;
            $newImage->file_path = $imagePath;
            $newImage->save();

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully.',
                'data' => $newImage,
            ], 201);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while uploading the image.',
            ], 500);
        }
    }


    // Menampilkan detail gambar
    public function show($id): JsonResponse
    {
        try {
            $image = Image::findOrFail($id);
            $image->file_path = asset('storage/' . $image->file_path);
            return response()->json(['success' => true, 'data' => $image], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data gambar: ' . $e->getMessage(),
            ], 404);
        }
    }

    // Memperbarui gambar
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:images,name,' . $id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:80000',
            ], [
                'name.required' => 'Nama gambar harus diisi.',
                'name.unique' => 'Nama gambar sudah digunakan.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'image.max' => 'Ukuran file gambar maksimal 80MB.',
            ]);

            $image = Image::findOrFail($id);

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($image->file_path);
                $filePath = $request->file('image')->store('uploads', 'public');
                $image->file_path = $filePath;
            }

            $image->name = $request->name;
            $image->save();

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil diperbarui.',
                'data' => $image,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui gambar: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Menghapus gambar
    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $image = Image::findOrFail($id);

            Storage::disk('public')->delete($image->file_path);
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil dihapus.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus gambar: ' . $e->getMessage(),
            ], 500);
        }
    }
}
