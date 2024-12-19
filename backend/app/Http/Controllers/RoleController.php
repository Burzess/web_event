<?php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    // Menampilkan semua roles
    public function index(): JsonResponse
    {
        try {
            $roles = Role::all();
            return response()->json(['success' => true, 'data' => $roles], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to retrieve roles: ' . $e->getMessage()], 500);
        }
    }

    // Menyimpan role baru
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name',
            ], [
                'name.required' => 'Role name is required.',
                'name.max' => 'Role name must not exceed 255 characters.',
                'name.unique' => 'Role name already exists.',
            ]);

            $role = Role::create($request->all());

            return response()->json(['success' => true, 'message' => 'Role created successfully.', 'data' => $role], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create role: ' . $e->getMessage()], 500);
        }
    }

    // Menampilkan detail role
    public function show($id): JsonResponse
    {
        try {
            $role = Role::findOrFail($id);
            return response()->json(['success' => true, 'data' => $role], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Role not found: ' . $e->getMessage()], 404);
        }
    }

    // Mengupdate role
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $id,
            ], [
                'name.required' => 'Role name is required.',
                'name.max' => 'Role name must not exceed 255 characters.',
                'name.unique' => 'Role name already exists.',
            ]);

            $role = Role::findOrFail($id);
            $role->update($request->all());

            return response()->json(['success' => true, 'message' => 'Role updated successfully.', 'data' => $role], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update role: ' . $e->getMessage()], 500);
        }
    }

    // Menghapus role
    public function destroy($id): JsonResponse
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return response()->json(['success' => true, 'message' => 'Role deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete role: ' . $e->getMessage()], 500);
        }
    }
}
