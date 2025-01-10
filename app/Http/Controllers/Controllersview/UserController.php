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
            $user = auth()->id();
            $users = User::where('created_by', $user)->get();
            \Log::info($users);

            return view('owner.organizers.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ['message' => 'Gagal mengambil data pengguna: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        try {
            $user = auth()->user();
            if ($user->hasRole('owner')) return view('owner.organizers.create');
            if ($user->hasRole('organizer')) return view('organizer.admin.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat form pembuatan pengguna: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
        ]);

        try {
            $user = auth()->user();
            \Log::info($user->id);

            $newUser = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'created_by' => $user->id,
            ]);

            if ($user->hasRole('owner')) $newUser->assignRole('organizer');
            if ($user->hasRole('organizer')) $newUser->assignRole('admin');


            \Log::info("success");
            return redirect()->route('owner.organizers.index')->with('success', 'Organisasi berhasil dibuat.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('owner.organizers.index')->with('error', ['message' => 'Gagal menambahkan pengguna: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:3',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $request->password ? bcrypt($request->password) : $user->password,
            ]);

            return redirect()->route('owner.organizers.index')->with('success', 'Organisasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui pengguna: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ['message' => 'Gagal menghapus pengguna: ' . $e->getMessage()]);
        }
    }
}
