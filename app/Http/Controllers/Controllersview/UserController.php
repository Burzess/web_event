<?php
namespace App\Http\Controllers\Controllersview;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Organizer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::with(['role', 'organizer'])->get();
            return view('users.index', compact('users')); // Pastikan view ini ada
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal mengambil data pengguna: ' . $e->getMessage()]);
        }
    }
    public function create()
    {
        try {
            $roles = Role::all();
            $organizers = Organizer::all();
            return view('users.create', compact('roles', 'organizers')); 
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal memuat form pembuatan pengguna: ' . $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
            'role_id' => 'nullable|exists:roles,id',
            'organizer_id' => 'nullable|exists:organizers,id',
        ]);

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role_id' => $validated['role_id'],
                'organizer_id' => $validated['organizer_id'],
            ]);

            return redirect()->route('login')->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal menambahkan pengguna: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $user = User::with(['role', 'organizer'])->findOrFail($id);
            return view('users.show', compact('user')); 
        } catch (\Exception $e) {
            return view('error', ['message' => 'Pengguna tidak ditemukan.']);
        }
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $roles = Role::all();
            $organizers = Organizer::all();
            return view('users.edit', compact('user', 'roles', 'organizers')); 
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal memuat form pengeditan pengguna: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:3',
            'role_id' => 'nullable|exists:roles,id',
            'organizer_id' => 'nullable|exists:organizers,id',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $request->password ? bcrypt($request->password) : $user->password,
                'role_id' => $validated['role_id'],
                'organizer_id' => $validated['organizer_id'],
            ]);

            return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal memperbarui pengguna: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Gagal menghapus pengguna: ' . $e->getMessage()]);
        }
    }
}
