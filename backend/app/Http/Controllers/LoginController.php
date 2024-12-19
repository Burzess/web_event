<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Log;

class LoginController extends Controller
{
    // Menampilkan form login (dihapus, hanya untuk API)
    public function showLoginForm()
    {
        return response()->json(['message' => 'Login form is not available for API.'], 404);
    }

    // Login untuk API dan Web
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:3',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus memiliki minimal 3 karakter.',
        ]);

        $user = User::with('role', 'organizer')->where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'Email atau password salah.'], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Email atau password salah.'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil!',
            'token' => $token,
            'role' => $user->role->name,
        ], 200);
    
        // if (Auth::guard('admin')->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ], $request->filled('remember'))) {
        //     $user = Auth::guard('admin')->user();
    
        //     // Cek apakah request adalah JSON (API)
        //     if ($request->expectsJson()) {
        //         return response()->json([
        //             'message' => 'Login berhasil!',
        //             'user' => $user,
        //         ], 200);
        //     }
    
        //     // Jika bukan API, redirect ke dashboard (jika perlu)
        //     return response()->json(['message' => 'Login berhasil!'], 200);
        // }
    
        // // Jika autentikasi gagal
        // if ($request->expectsJson()) {
        //     return response()->json([
        //         'error' => 'Email atau password salah.',
        //     ], 401);
        // }
    
        // return response()->json(['error' => 'Email atau password salah.'], 401);
    }
    
    // Logout untuk API
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Anda telah logout.'], 200);
    }
}
