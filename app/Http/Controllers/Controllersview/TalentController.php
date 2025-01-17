<?php
namespace App\Http\Controllers\Controllersview;

use App\Http\Controllers\Controller;
use App\Models\Talent;
use App\Models\Organizer;
use App\Models\Image;
use App\Models\Role;
use Illuminate\Http\Request;

class TalentController extends Controller
{
    public function index()
    {
        try {
            $talents = Talent::with(['image'])->where('user_id', auth()->id())->get();
            return view('organizer.talents.index', compact('talents')); // Pastikan view ini ada
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data talent: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $organizers = Organizer::all();
            $images = Image::all();
            $roles = Role::all();
            return view('organizer.talents.create', compact('organizers', 'images', 'roles')); // Pastikan view ini ada
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ['message' => 'Gagal memuat form pembuatan talent: ' . $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image_id' => 'nullable|exists:images,id',
        ]);

        try {
            $talent = new Talent($validated);
            $talent->user_id = auth()->id();
            $talent->save();

            return redirect()->route('organizer.talents.index')->with('success', 'Talent berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ['message' => 'Gagal menambahkan talent: ' . $e->getMessage()]);
        }
    }
    public function show($id)
    {
        try {
            $talent = Talent::with(['image'])->findOrFail($id);
            return view('organizer.talents.show', compact('talent')); // Pastikan view ini ada
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ['message' => 'Talent tidak ditemukan: ' . $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        try {
            $talent = Talent::with('image')->findOrFail($id);
            return view('organizer.talents.edit', compact('talent', 'organizers', 'images', 'roles')); // Pastikan view ini ada
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ['message' => 'Talent tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:talents,name,' . $id,
            'image_id' => 'nullable|exists:images,id',
        ]);

        try {
            $talent = Talent::findOrFail($id);
            $talent->update($validated);

            return redirect()->route('organizer.talents.index')->with('success', 'Talent berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ['message' => 'Gagal memperbarui talent: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $talent = Talent::findOrFail($id);
            $talent->delete();

            return redirect()->route('organizer.talents.index')->with('success', 'Talent berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ['message' => 'Gagal menghapus talent: ' . $e->getMessage()]);
        }
    }
}
