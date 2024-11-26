<?php
namespace App\Http\Controllers;

use App\Models\Talent;
use App\Models\Organizer; // Tambahkan import Organizer
use App\Models\Image;
use App\Models\Role;
use Illuminate\Http\Request;

class TalentController extends Controller
{
    // Menampilkan semua talent dalam tampilan web
    public function index()
    {
        $talents = Talent::with(['organizer', 'image', 'role'])->get();
        return view('talents.index', compact('talents'));
    }

    // Menampilkan talent berdasarkan ID (untuk web)
    public function show($id)
    {
        $talent = Talent::with(['organizer', 'image', 'role'])->findOrFail($id);
        return view('talents.show', compact('talent'));
    }

    // Menampilkan form untuk membuat talent baru
    public function create()
    {
        // Ambil data yang diperlukan untuk form, seperti daftar organizer, image, dan role
        $organizers = Organizer::all();  // Pastikan Organizer diimpor
        $images = Image::all();
        $roles = Role::all();

        return view('talents.create', compact('organizers', 'images', 'roles'));
    }

    // Menyimpan talent baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'organizer' => 'nullable|exists:organizers,id',
            'image' => 'nullable|exists:images,id',
            'role' => 'nullable|exists:roles,id',
        ]);

        // Membuat talent baru dengan input dari form
        $talent = Talent::create([
            'name' => $request->input('name'),
            'organizer' => $request->input('organizer'),
            'image' => $request->input('image'),
            'role' => $request->input('role'),
        ]);

        // Redirect setelah berhasil membuat talent
        return redirect()->route('talents.index')->with('success', 'Talent created successfully!');
    }

    // Menampilkan form untuk mengedit talent
    public function edit($id)
    {
        // Ambil data talent beserta relasinya
        $talent = Talent::findOrFail($id);
        $organizers = Organizer::all();  // Pastikan Organizer diimpor
        $images = Image::all();
        $roles = Role::all();

        return view('talents.edit', compact('talent', 'organizers', 'images', 'roles'));
    }

    // Memperbarui talent berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'organizer' => 'nullable|exists:organizers,id',
            'image' => 'nullable|exists:images,id',
            'role' => 'nullable|exists:roles,id',
        ]);

        $talent = Talent::findOrFail($id);
        $talent->update($request->only('name', 'organizer', 'image', 'role'));

        // Redirect setelah berhasil mengupdate talent
        return redirect()->route('talents.index')->with('success', 'Talent updated successfully!');
    }

    // Menghapus talent berdasarkan ID
    public function destroy($id)
    {
        $talent = Talent::findOrFail($id);
        $talent->delete();

        // Redirect setelah berhasil menghapus talent
        return redirect()->route('talents.index')->with('success', 'Talent deleted successfully!');
    }
}
