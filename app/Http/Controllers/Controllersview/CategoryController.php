<?php
namespace App\Http\Controllers\Controllersview;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Organizer;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $categories = Category::with('user')->where('user_id', auth()->id())->get();
            return view('organizer.categories.index', ['categories' => $categories]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',  'Gagal mengambil data kategori: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $organizers = Organizer::all();
            return view('organizer.categories.create', ['organizers' => $organizers]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat form kategori: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $category = Category::create($validated + ['user_id' => auth()->id()]);

            return redirect()->route('organizer.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $category = Category::with('organizer')->findOrFail($id);
            return view('organizer.categories.show', ['category' => $category]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('organizer.categories.edit', ['category' => $category]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat form edit kategori: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            // 'organizer_id' => 'required|exists:organizers,id',
        ], [
            'name.required' => 'Nama kategori harus diisi.',
            'name.unique' => 'Nama kategori sudah digunakan.',
            // 'organizer_id.required' => 'Organizer harus dipilih.',
            // 'organizer_id.exists' => 'Organizer yang dipilih tidak valid.',
        ]);

        try {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->input('name'),
            ]);

            return redirect()->route('organizer.categories.index')->with('success', 'Kategori berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ['message' => 'Gagal memperbarui kategori: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('organizer.categories.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
