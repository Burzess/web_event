<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    // Menampilkan semua gambar
    public function index()
    {
        $images = Image::all();
        return response()->json($images);
    }

    // Menampilkan gambar berdasarkan ID
    public function show($id)
    {
        $image = Image::findOrFail($id);
        return response()->json($image);
    }

    // Menyimpan gambar baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $image = Image::create([
            'name' => $request->name,
        ]);

        return response()->json($image, 201);
    }

    // Memperbarui gambar berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $image = Image::findOrFail($id);
        $image->update([
            'name' => $request->name,
        ]);

        return response()->json($image);
    }

    // Menghapus gambar berdasarkan ID
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        return response()->json(['message' => 'Image deleted successfully']);
    }
}
