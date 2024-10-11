<?php

namespace App\Http\Controllers;

use App\Models\Lembur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LemburController extends Controller
{
    // Menampilkan semua data lembur
    public function index()
    {
        $dataLembur = Lembur::all();
        return response()->json($dataLembur);
    }

    // Menyimpan data lembur baru
    public function store(Request $request)
    {
        // Validasi data yang dikirim
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required|exists:employees,id', // pastikan id karyawan ada di tabel employees
            'tanggal_lembur' => 'required|date',
            'jam_lembur' => 'required|date_format:H:i',
            'upah_lembur' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Simpan data lembur
        $lembur = Lembur::create([
            'id_karyawan' => $request->id_karyawan,
            'tanggal_lembur' => $request->tanggal_lembur,
            'jam_lembur' => $request->jam_lembur,
            'upah_lembur' => $request->upah_lembur,
        ]);

        return response()->json(['message' => 'Data lembur berhasil disimpan', 'data' => $lembur], 201);
    }

    // Menampilkan data lembur berdasarkan ID
    public function show($id)
    {
        $lembur = Lembur::find($id);

        if (!$lembur) {
            return response()->json(['message' => 'Data lembur tidak ditemukan'], 404);
        }

        return response()->json($lembur);
    }

    // Mengupdate data lembur berdasarkan ID
    public function update(Request $request, $id)
    {
        $lembur = Lembur::find($id);

        if (!$lembur) {
            return response()->json(['message' => 'Data lembur tidak ditemukan'], 404);
        }

        // Validasi data yang dikirim
        $validator = Validator::make($request->all(), [
            'tanggal_lembur' => 'required|date',
            'jam_lembur' => 'required|date_format:H:i',
            'upah_lembur' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Update data lembur
        $lembur->update([
            'tanggal_lembur' => $request->tanggal_lembur,
            'jam_lembur' => $request->jam_lembur,
            'upah_lembur' => $request->upah_lembur,
        ]);

        return response()->json(['message' => 'Data lembur berhasil diupdate', 'data' => $lembur]);
    }

    // Menghapus data lembur
    public function destroy($id)
    {
        $lembur = Lembur::find($id);

        if (!$lembur) {
            return response()->json(['message' => 'Data lembur tidak ditemukan'], 404);
        }

        $lembur->delete();
        return response()->json(['message' => 'Data lembur berhasil dihapus']);
    }
}
