<?php

namespace App\Http\Controllers\Controllersview;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Exception;

class RoleController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::all();
            return view('roles.index', compact('roles'));
        } catch (Exception $e) {
            return view('error', ['message' => 'Failed to retrieve roles: ' . $e->getMessage()]);
        }
    }

    public function store(Request $request)
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

            return redirect()->route('roles.index')->with('success', 'Role created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create role: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        try {
            $role = Role::findOrFail($id);
            return view('roles.show', compact('role'));
        } catch (Exception $e) {
            return view('error', ['message' => 'Role not found: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
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

            return redirect()->route('roles.show', $role->id)->with('success', 'Role updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update role: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('roles.index')->with('error', 'Failed to delete role: ' . $e->getMessage());
        }
    }
}
