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
            $talents = Talent::with(['organizer', 'image', 'role'])->get();
            return view('talents.index', compact('talents')); // Pastikan view ini ada
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal mengambil data talent: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        try {
            $organizers = Organizer::all();
            $images = Image::all();
            $roles = Role::all();
            return view('talents.create', compact('organizers', 'images', 'roles')); // Pastikan view ini ada
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal memuat form pembuatan talent: ' . $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:talents,name',
                'organizer_id' => 'nullable|exists:organizers,id',
                'image_id' => 'nullable|exists:images,id',
                'role_id' => 'nullable|exists:roles,id',
            ]);

            Talent::create($request->only(['name', 'organizer_id', 'image_id', 'role_id']));

            return redirect()->route('talents.index')->with('success', 'Talent berhasil ditambahkan.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal menambahkan talent: ' . $e->getMessage()]);
        }
    }
    public function show($id)
    {
        try {
            $talent = Talent::with(['organizer', 'image', 'role'])->findOrFail($id);
            return view('talents.show', compact('talent')); // Pastikan view ini ada
        } catch (\Exception $e) {
            return view('error', ['message' => 'Talent tidak ditemukan: ' . $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        try {
            $talent = Talent::findOrFail($id);
            $organizers = Organizer::all();
            $images = Image::all();
            $roles = Role::all();
            return view('talents.edit', compact('talent', 'organizers', 'images', 'roles')); // Pastikan view ini ada
        } catch (\Exception $e) {
            return view('error', ['message' => 'Talent tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:talents,name,' . $id,
                'organizer_id' => 'nullable|exists:organizers,id',
                'image_id' => 'nullable|exists:images,id',
                'role_id' => 'nullable|exists:roles,id',
            ]);

            $talent = Talent::findOrFail($id);
            $talent->update($request->only(['name', 'organizer_id', 'image_id', 'role_id']));

            return redirect()->route('talents.index')->with('success', 'Talent berhasil diperbarui.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal memperbarui talent: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $talent = Talent::findOrFail($id);
            $talent->delete();

            return redirect()->route('talents.index')->with('success', 'Talent berhasil dihapus.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal menghapus talent: ' . $e->getMessage()]);
        }
    }
}
