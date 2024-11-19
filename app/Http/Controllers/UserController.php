<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Organizer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan semua users
    public function index()
    {
        $users = User::with('role', 'organizer')->get();
        return view('users.index', compact('users'));
    }


    // Menampilkan form untuk menambah user
    public function create()
    {
        $roles = Role::all(); // Ambil semua role
        $organizers = Organizer::all(); // Ambil semua organizer
        return view('users.create', compact('roles', 'organizers')); // Mengarahkan ke view create
    }


    // Menyimpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'nullable|exists:roles,id',
            'organizer' => 'nullable|exists:organizers,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'organizer' => $request->organizer,
            'refresh_token' => $request->refresh_token,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Menampilkan form untuk mengedit user
    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan id
        $roles = Role::all();
        $organizers = Organizer::all();
        return view('users.edit', compact('user', 'roles', 'organizers'));
    }

    // Mengupdate user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|exists:roles,id',
            'organizer' => 'nullable|exists:organizers,id',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
            'organizer' => $request->organizer,
            'refresh_token' => $request->refresh_token,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Hapus user
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
