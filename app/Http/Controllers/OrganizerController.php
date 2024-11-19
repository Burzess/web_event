<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    // Menampilkan semua organizers
    public function index()
    {
        $organizers = Organizer::all(); // Ambil semua data organizer
        return view('organizers.index', compact('organizers'));
    }

    // Menampilkan form untuk menambah organizer
    public function create()
    {
        return view('organizers.create');
    }

    // Menyimpan organizer baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Organizer::create($request->all()); // Simpan organizer baru
        return redirect()->route('organizers.index')->with('success', 'Organizer created successfully.');
    }

    // Menampilkan form untuk mengedit organizer
    public function edit($id)
    {
        $organizer = Organizer::findOrFail($id); // Cari organizer berdasarkan id
        return view('organizers.edit', compact('organizer'));
    }

    // Mengupdate organizer
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $organizer = Organizer::findOrFail($id);
        $organizer->update($request->all()); // Update data organizer
        return redirect()->route('organizers.index')->with('success', 'Organizer updated successfully.');
    }

    // Menghapus organizer
    public function destroy($id)
    {
        $organizer = Organizer::findOrFail($id);
        $organizer->delete(); // Hapus organizer
        return redirect()->route('organizers.index')->with('success', 'Organizer deleted successfully.');
    }
}
