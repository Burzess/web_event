<?php

namespace App\Http\Controllers;

use App\Models\ParticipantForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ParticipantForgotPasswordController extends Controller
{
    public function index(): JsonResponse
    {
        $forgotPasswords = ParticipantForgotPassword::all();
        return response()->json([
            'message' => 'Forgot password entries retrieved successfully.',
            'data' => $forgotPasswords
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'code' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'active_code' => 'nullable|string|max:255',
                'participant_id' => 'required|exists:participants,id',
            ]);
    
            $forgotPassword = ParticipantForgotPassword::create($validated);
    
            return response()->json([
                'message' => 'Entri permintaan lupa password berhasil dibuat.',
                'data' => $forgotPassword
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat membuat entri permintaan lupa password.',
                'error' => $e->getMessage()
            ], 500);
        }
    }    

    public function show($id): JsonResponse
    {
        $forgotPassword = ParticipantForgotPassword::findOrFail($id);

        return response()->json([
            'message' => 'Forgot password entry retrieved successfully.',
            'data' => $forgotPassword
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $forgotPassword = ParticipantForgotPassword::findOrFail($id);

        $validated = $request->validate([
            'code' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|max:255',
            'active_code' => 'nullable|string|max:255',
            'participant_id' => 'sometimes|exists:participants,id',
        ]);

        $forgotPassword->update($validated);

        return response()->json([
            'message' => 'Forgot password entry updated successfully.',
            'data' => $forgotPassword
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $forgotPassword = ParticipantForgotPassword::findOrFail($id);
        $forgotPassword->delete();

        return response()->json([
            'message' => 'Forgot password entry deleted successfully.'
        ]);
    }
}
