<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    // Menampilkan semua users
    public function index(): JsonResponse
    {
        try {
            $users = User::with('role', 'organizer')->get(); // Mengambil koleksi user
            return response()->json([
                'success' => true,
                'data' => $users->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => $user->password,
                        'role' => $user->role ? $user->role->name : null,
                        'organizer' => $user->organizer ? $user->organizer->name : null,
                    ];
                }),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Menyimpan user baru
    public function store(Request $request): JsonResponse
    {
        // Validasi input dari pengguna
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
            'role_id' => 'nullable|exists:roles,id',
            'organizer_id' => 'nullable|exists:organizers,id',
        ], [
            'name.required' => 'Nama pengguna harus diisi.',
            'name.unique' => 'Nama pengguna sudah digunakan, silakan pilih nama lain.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus memiliki minimal 3 karakter.',
            'role_id.exists' => 'Role tidak ditemukan.',
            'organizer_id.exists' => 'Organizer tidak ditemukan.',
        ]);
    
        try {
            // Membuat user baru dengan data yang sudah tervalidasi
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role_id' => $validated['role_id'],
                'organizer_id' => $validated['organizer_id'],
            ]);
    
            return response()->json([
                'success' => true,
                'data' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Menampilkan data user berdasarkan ID
    public function show($id): JsonResponse
    {
        try {
            $user = User::with('role', 'organizer')->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }
    }

    // Mengupdate data user
    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:3',
            'role_id' => 'nullable|exists:roles,id',
            'organizer_id' => 'nullable|exists:organizers,id',
        ], [
            'name.required' => 'Nama pengguna harus diisi.',
            'name.unique' => 'Nama pengguna sudah digunakan, silakan pilih nama lain.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
            'password.min' => 'Password harus memiliki minimal 3 karakter.',
            'role_id.exists' => 'Role tidak ditemukan.',
            'organizer_id.exists' => 'Organizer tidak ditemukan.',
        ]);
    
        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
                'role_id' => $request->role_id,
                'organizer_id' => $request->organizer_id,
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully.',
                'data' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Menghapus user
    public function destroy($id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user: ' . $e->getMessage(),
            ], 500);
        }
    }
}
