<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use App\Models\Organizer;
use App\Models\Image;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TalentController extends Controller
{
    public function index()
    {
        $talents = Talent::with(['organizer', 'image', 'role'])->get();
        return view('talents.index', compact('talents'));
    }

    public function show($id): View
    {
        $talent = Talent::with(['organizer', 'image', 'role'])->findOrFail($id);
        return view('talents.show', compact('talent'));
    }
    public function create(): View
    {
        $organizers = Organizer::all();
        $images = Image::all();
        $roles = Role::all();

        return view('talents.create', compact('organizers', 'images', 'roles'));
    }

    // Menyimpan talent baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'organizer_id' => 'nullable|exists:organizers,id',
            'image_id' => 'nullable|exists:images,id',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        Talent::create([
            'name' => $request->input('name'),
            'organizer_id' => $request->input('organizer_id'),
            'image_id' => $request->input('image_id'),
            'role_id' => $request->input('role_id'),
        ]);

        return redirect()->route('talents.index')->with('success', 'Talent berhasil ditambahkan.');
    }

    public function edit($id): View
    {
        $talent = Talent::findOrFail($id);
        $organizers = Organizer::all();
        $images = Image::all();
        $roles = Role::all();

        return view('talents.edit', compact('talent', 'organizers', 'images', 'roles'));
    }

    // Mengupdate data talent
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'organizer_id' => 'nullable|exists:organizers,id',
            'image_id' => 'nullable|exists:images,id',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        $talent = Talent::findOrFail($id);
        $talent->update([
            'name' => $request->input('name'),
            'organizer_id' => $request->input('organizer_id'),
            'image_id' => $request->input('image_id'),
            'role_id' => $request->input('role_id'),
        ]);

        return redirect()->route('talents.index')->with('success', 'Talent berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        $talent = Talent::findOrFail($id);
        $talent->delete();

        return redirect()->route('talents.index')->with('success', 'Talent deleted successfully.');
    }
}
