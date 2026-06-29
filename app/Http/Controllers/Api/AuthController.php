<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'usia' => 'nullable|integer',
            'jenis_kelamin' => 'nullable|string',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        $token = $user->createToken('skinscan-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'token' => $token,
            'user' => $user
        ], 201);
    }

    public function login(Request $request) {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Email atau password salah'], 401);
        }

        $user->tokens()->delete();
        $token = $user->createToken('skinscan-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user
        ]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, 'message' => 'Logout berhasil']);
    }

    public function getCurrentUser(Request $request) {
        return response()->json(['success' => true, 'user' => $request->user()]);
    }

    public function sendVerificationOtp(Request $request) {
        $user = $request->user();
        $otp = rand(100000, 999999);
        Cache::put('email_otp_' . $user->email, $otp, now()->addMinutes(10));

        Mail::raw("Kode verifikasi Anda: $otp. Berlaku 10 menit.", function ($message) use ($user) {
            $message->to($user->email)->subject("Verifikasi Email SkinScan AI");
        });

        return response()->json(['success' => true, 'message' => 'Kode OTP berhasil dikirim']);
    }

    public function verifyEmailOtp(Request $request) {
        $request->validate(['otp' => 'required|numeric|digits:6']);
        $user = $request->user();
        $cachedOtp = Cache::get('email_otp_' . $user->email);

        if (!$cachedOtp || $cachedOtp != $request->otp) {
            return response()->json(['success' => false, 'message' => 'OTP salah atau kedaluwarsa'], 422);
        }

        $user->forceFill(['email_verified_at' => now()])->save();
        Cache::forget('email_otp_' . $user->email);

        return response()->json(['success' => true, 'message' => 'Email berhasil diverifikasi']);
    }

    public function verifyUser(Request $request) {
        $request->validate(['email' => 'required|email', 'nama' => 'required|string']);
        $user = User::where('email', $request->email)->where('nama', $request->nama)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Email dan nama tidak cocok'], 442);
        }
        return response()->json(['success' => true, 'message' => 'Identitas valid']);
    }

    public function resetPassword(Request $request) {
        $request->validate(['email' => 'required|email', 'nama' => 'required|string', 'new_password' => 'required|min:6']);
        $user = User::where('email', $request->email)->where('nama', $request->nama)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 442);
        }

        $user->update(['password' => Hash::make($request->new_password)]);
        return response()->json(['success' => true, 'message' => 'Password berhasil direset']);
    }

    public function updateProfile(Request $request) {
        $user = $request->user();
        $request->validate([
            'nama' => 'required|string|max:255',
            'usia' => 'nullable|integer',
            'jenis_kelamin' => 'nullable|string',
            'foto_profile' => 'nullable|image|max:2048',
            'old_password' => 'nullable',
            'new_password' => 'nullable|min:6',
        ]);

        if ($request->filled('old_password') && $request->filled('new_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['success' => false, 'message' => 'Password lama salah'], 422);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->nama = $request->nama;
        $user->usia = $request->usia;
        $user->jenis_kelamin = $request->jenis_kelamin;

        if ($request->hasFile('foto_profile')) {
            $path = $request->file('foto_profile')->store('avatars', 'public');
            $user->foto_profile = asset('storage/' . $path);
        }

        $user->save();
        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui', 'user' => $user]);
    }
}