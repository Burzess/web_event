<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // Menampilkan semua gambar
    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    // Menampilkan form untuk menambahkan gambar
    public function create()
    {
        return view('images.create');
    }

    // Menyimpan gambar baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:80000',
        ]);
    
        // Periksa apakah file 'image' ada di request
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('uploads', 'public');
    
            // Simpan data ke database
            Image::create([
                'name' => $request->name,
                'file_path' => $filePath,
            ]);
    
            // Tambahkan pesan sukses
            return redirect()->route('images.index')->with('success', 'Image has been successfully posted!');
        } else {
            return back()->withErrors(['image' => 'Image file is required.']);
        }
    }
    
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('images.edit', compact('image'));
    }

    // Memperbarui gambar
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
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

        return redirect()->route('images.index')->with('success', 'Image updated successfully.');
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        // Hapus file dari storage
        Storage::disk('public')->delete($image->file_path);

        $image->delete();

        return redirect()->route('images.index')->with('success', 'Image deleted successfully.');
    }
}
