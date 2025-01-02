<?php

namespace App\Http\Controllers\Controllersview;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    
    public function index()
    {
        try {
            $organizers = Organizer::all();
            return view('organizers.index', compact('organizers'));
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal mengambil data organizer: ' . $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:organizers,name',
            ]);

            Organizer::create($request->all());
            return redirect()->route('organizers.index')->with('success', 'Organizer berhasil dibuat.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal membuat organizer: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $organizer = Organizer::findOrFail($id);
            return view('organizers.show', compact('organizer'));
        } catch (\Exception $e) {
            return view('error', ['message' => 'Organizer tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:organizers,name,' . $id,
            ]);

            $organizer = Organizer::findOrFail($id);
            $organizer->update($request->all());

            return redirect()->route('organizers.show', $organizer->id)->with('success', 'Organizer berhasil diperbarui.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal memperbarui organizer: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $organizer = Organizer::findOrFail($id);
            $organizer->delete();

            return redirect()->route('organizers.index')->with('success', 'Organizer berhasil dihapus.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal menghapus organizer: ' . $e->getMessage()]);
        }
    }
}
