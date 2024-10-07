<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input untuk register
        $request->validate([
            'nama_karyawan' => 'required|string|max:255', // Nama Karyawan
            'nik' => 'required|string|max:16',             // NIK
            'email' => 'required|string|email|max:255|unique:users', // Email
            'no_handphone' => 'required|string|max:15',    // No Handphone
            'alamat' => 'required|string|max:255',         // Alamat
            'kata_sandi' => 'required|string|min:6',       // Kata Sandi
            'konfirmasi_kata_sandi' => 'required|same:kata_sandi', // Konfirmasi Kata Sandi
        ]);

        // Membuat user baru
        return User::create([
            'name' => $request->input('nama_karyawan'),        // Menyimpan nama karyawan
            'nik' => $request->input('nik'),                     // Menyimpan NIK
            'email' => $request->input('email'),                 // Menyimpan email
            'noHandphone' => $request->input('no_handphone'),   // Menyimpan no handphone
            'alamat' => $request->input('alamat'),               // Menyimpan alamat
            'password' => Hash::make($request->input('kata_sandi')) // Meng-hash kata sandi
        ]);
    }

    public function login(Request $request)
    {
        // Validasi data request
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required', // Mengubah sesuai inputan
        ]);

        // Mencoba autentikasi pengguna
        if (!Auth::attempt($request->only('email', 'kata_sandi'))) {
            // Mencatat percobaan login yang gagal
            \Log::warning('Login attempt failed for email: ' . $request->email);

            return response()->json(['message' => 'Invalid credentials!'], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        // Membuat token untuk pengguna yang terautentikasi
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function user()
    {
        $user = Auth::user();

        if ($user) {
            // Mengembalikan data pengguna yang sedang login
            return response()->json($user, 200);
        }

        return response()->json([
            'message' => 'Unauthenticated.'
        ], 401);
    }

    public function logout(Request $request)
    {
        // Menghapus token akses saat ini
        $request->user()->currentAccessToken()->delete();

        // Hapus cookie JWT jika digunakan
        $cookie = Cookie::forget('jwt');

        return response()->json([
            'message' => 'Successfully logged out'
        ])->withCookie($cookie); // Mengembalikan cookie ke response
    }
}
