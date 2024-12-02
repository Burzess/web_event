<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index(): View
    {
        $categories = Category::with('organizer')->get();
        return view('categories.index', compact('categories'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create(): View
    {
        $organizers = Organizer::all();
        return view('categories.create', compact('organizers'));
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'organizer_id' => 'required|exists:organizers,id',
        ]);

        Category::create([
            'name' => $request->input('name'),
            'organizer_id' => $request->input('organizer_id'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan detail kategori berdasarkan ID
    public function show($id): JsonResponse
    {
        $category = Category::with('organizer')->findOrFail($id);
        return response()->json($category);
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id): View
    {
        $category = Category::findOrFail($id);
        $organizers = Organizer::all();
        return view('categories.edit', compact('category', 'organizers'));
    }

    // Mengupdate kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'organizer_id' => 'required|exists:organizers,id',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->input('name'),
            'organizer_id' => $request->input('organizer_id'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diubah.');
    }

    // Menghapus kategori berdasarkan ID
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
