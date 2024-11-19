<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Menampilkan semua roles
    public function index()
    {
        $roles = Role::all(); // Ambil semua data role
        return view('roles.index', compact('roles'));
    }

    // Menampilkan form untuk menambah role
    public function create()
    {
        return view('roles.create');
    }

    // Menyimpan role baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Role::create($request->all()); // Simpan role baru
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    // Menampilkan form untuk mengedit role
    public function edit($id)
    {
        $role = Role::findOrFail($id); // Cari role berdasarkan id
        return view('roles.edit', compact('role'));
    }

    // Mengupdate role
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->all()); // Update data role
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Menghapus role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete(); // Hapus role
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
