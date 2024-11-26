<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        $categories = Category::with('organizer')->get(); // Mengambil kategori beserta organizer-nya
        return response()->json($categories);
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'organizer_id' => 'nullable|exists:organizers,id',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'organizer_id' => $request->organizer_id,
        ]);

        return response()->json($category, 201);
    }

    /**
     * Menampilkan kategori berdasarkan ID.
     */
    public function show($id)
    {
        $category = Category::with('organizer')->findOrFail($id);
        return response()->json($category);
    }

    /**
     * Mengupdate kategori.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'organizer_id' => 'nullable|exists:organizers,id',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'organizer_id' => $request->organizer_id,
        ]);

        return response()->json($category);
    }

    /**
     * Menghapus kategori.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }
}
