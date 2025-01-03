<?php

namespace App\Http\Controllers\Controllersview;


use App\Http\Controllers\Controller;
use App\Models\ParticipantForgotPassword;
use Illuminate\Http\Request;

class ParticipantForgotPasswordController extends Controller
{
    public function index()
    {
        $forgotPasswords = ParticipantForgotPassword::all();
        return view('forgot_passwords.index', compact('forgotPasswords'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'code' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'active_code' => 'nullable|string|max:255',
                'participant_id' => 'required|exists:participants,id',
            ]);

            ParticipantForgotPassword::create($validated);

            return redirect()->route('forgot_passwords.index')->with('success', 'Entri permintaan lupa password berhasil dibuat.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat membuat entri permintaan lupa password: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $forgotPassword = ParticipantForgotPassword::findOrFail($id);
        return view('forgot_passwords.show', compact('forgotPassword'));
    }

    public function update(Request $request, $id)
    {
        try {
            $forgotPassword = ParticipantForgotPassword::findOrFail($id);

            $validated = $request->validate([
                'code' => 'sometimes|string|max:255',
                'status' => 'sometimes|string|max:255',
                'active_code' => 'nullable|string|max:255',
                'participant_id' => 'sometimes|exists:participants,id',
            ]);

            $forgotPassword->update($validated);

            return redirect()->route('forgot_passwords.show', $forgotPassword->id)->with('success', 'Entri permintaan lupa password berhasil diperbarui.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat memperbarui entri: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $forgotPassword = ParticipantForgotPassword::findOrFail($id);
            $forgotPassword->delete();

            return redirect()->route('forgot_passwords.index')->with('success', 'Entri permintaan lupa password berhasil dihapus.');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Terjadi kesalahan saat menghapus entri: ' . $e->getMessage()]);
        }
    }
}
