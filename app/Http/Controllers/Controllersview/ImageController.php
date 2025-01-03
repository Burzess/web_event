<?php

namespace App\Http\Controllers\Controllersview;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // Menampilkan semua gambar
    public function index()
    {
        try {
            $images = Image::all();
            return view('images.index', compact('images'));
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal mengambil data gambar: ' . $e->getMessage()]);
        }
    }

    // Menyimpan gambar baru
    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('image');
            $imagePath = $image->store('uploads', 'public');

            // Simpan informasi gambar ke database
            $newImage = new Image();
            $newImage->name = $request->input('name', 'Untitled Image');
            $newImage->file_path = $imagePath;
            $newImage->save();

            return redirect()->route('images.index')->with('success', 'Gambar berhasil ditambahkan.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal menambahkan gambar: ' . $e->getMessage()]);
        }
    }

    // Menampilkan detail gambar
    public function show($id)
    {
        try {
            $image = Image::findOrFail($id);
            return view('images.show', compact('image'));
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal memuat data gambar: ' . $e->getMessage()]);
        }
    }

    // Memperbarui gambar
    public function edit($id)
    {
        try {
            $image = Image::findOrFail($id);
            return view('images.edit', compact('image'));
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal memuat data gambar: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:images,name,' . $id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:80000',
            ]);

            $image = Image::findOrFail($id);

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($image->file_path);
                $filePath = $request->file('image')->store('uploads', 'public');
                $image->file_path = $filePath;
            }

            $image->name = $request->name;
            $image->save();

            return redirect()->route('images.index')->with('success', 'Gambar berhasil diperbarui.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal memperbarui gambar: ' . $e->getMessage()]);
        }
    }

    // Menghapus gambar
    public function destroy($id)
    {
        try {
            $image = Image::findOrFail($id);

            Storage::disk('public')->delete($image->file_path);
            $image->delete();

            return redirect()->route('images.index')->with('success', 'Gambar berhasil dihapus.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal menghapus gambar: ' . $e->getMessage()]);
        }
    }
}
