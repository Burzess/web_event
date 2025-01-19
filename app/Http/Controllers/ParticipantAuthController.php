<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('participant')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegistForm(){
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:participants',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required_with:password|same:password|min:6',
            'status' => 'required|string|max:255',
        ]);

        $participant = Participant::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);

        Auth::guard('participant')->login($participant);

        return redirect()->route('home')->with('status', 'Participant created successfully! Please login.');
    }

    public function logout()
    {
        Auth::guard('participant')->logout();
        return redirect('/participant/login');
    }
}
