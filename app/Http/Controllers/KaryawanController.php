<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; // Tambahkan ini

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();
        return response()->json($karyawan);
    }

    // Menyimpan karyawan baru
    public function store(Request $request)
{
    // Validasi data yang diterima menggunakan Validator
    $validator = Validator::make($request->all(), [
        'nama_karyawan' => 'required|string|max:255',
        'nik' => 'required|unique:karyawans,nik|max:20',
        'email' => 'required|email|unique:karyawans,email|max:255',
        'no_handphone' => 'required|string|max:15',
        'alamat' => 'required|string|max:255',
        'password' => 'required|min:6',
    ]);

    // Cek jika ada kesalahan validasi
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Buat data karyawan baru dan simpan ke database
    $karyawan = Karyawan::create([
        'nama_karyawan' => $request->nama_karyawan,
        'nik' => $request->nik,
        'email' => $request->email,
        'no_handphone' => $request->no_handphone,
        'alamat' => $request->alamat,
        'password' => Hash::make($request->password),
    ]);

    // Kembalikan respon sukses
    return response()->json(['message' => 'Karyawan created successfully', 'data' => $karyawan], 201);
}

    // Menampilkan detail karyawan berdasarkan ID
    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return response()->json($karyawan, 200);
    }

    // Memperbarui data karyawan
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        // Validasi update
        $validated = $request->validate([
            'nama_karyawan' => 'string|max:255|nullable',
            'nik' => 'string|max:20|unique:karyawans,nik,' . $karyawan->id,
            'email' => 'string|email|max:255|unique:karyawans,email,' . $karyawan->id,
            'no_handphone' => 'string|max:15|nullable',
            'alamat' => 'string|max:255|nullable',
            'password' => 'string|min:6|nullable', // Opsional, hanya diupdate jika disediakan
        ]);

        // Jika password disediakan, hash password baru
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Update data karyawan
        $karyawan->update(array_filter($validated)); // Hanya update yang terisi

        return response()->json(['message' => 'Karyawan updated successfully', 'data' => $karyawan], 200);
    }

    // Menghapus karyawan
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return response()->json(['message' => 'Karyawan deleted successfully'], 204);
    }
}
