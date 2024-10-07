<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JabatanController extends Controller
{
    // Data jabatan yang statis untuk keperluan contoh
    private $positions = [
        ['id' => 1, 'name' => 'HRD', 'baseSalary' => 4000000, 'transportAllowance' => 600000, 'mealAllowance' => 400000],
        ['id' => 2, 'name' => 'Staff Marketing', 'baseSalary' => 2500000, 'transportAllowance' => 300000, 'mealAllowance' => 200000],
        ['id' => 3, 'name' => 'Admin', 'baseSalary' => 2200000, 'transportAllowance' => 300000, 'mealAllowance' => 200000],
        ['id' => 4, 'name' => 'Sales', 'baseSalary' => 2500000, 'transportAllowance' => 300000, 'mealAllowance' => 200000],
    ];

    // Fungsi untuk menghitung total gaji
    private function calculateTotal($position)
    {
        return $position['baseSalary'] + $position['transportAllowance'] + $position['mealAllowance'];
    }

    // Menampilkan semua data jabatan
    public function index()
    {
        $positions = $this->positions;

        // Hitung total gaji untuk setiap jabatan
        foreach ($positions as &$position) {
            $position['total'] = $this->calculateTotal($position);
        }

        return view('jabatan.index', compact('positions'));
    }

    // Menampilkan form untuk tambah jabatan baru (mockup untuk contoh)
    public function create()
    {
        return view('jabatan.create');
    }

    // Simpan data jabatan baru ke database (mockup untuk contoh)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'baseSalary' => 'required|numeric',
            'transportAllowance' => 'required|numeric',
            'mealAllowance' => 'required|numeric',
        ]);

        // Logika simpan jabatan (mockup untuk contoh, sesuaikan dengan database)
        // $newPosition = Jabatan::create([...]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    // Menampilkan form edit jabatan (mockup untuk contoh)
    public function edit($id)
    {
        $position = collect($this->positions)->firstWhere('id', $id);

        if (!$position) {
            abort(404, 'Jabatan tidak ditemukan');
        }

        return view('jabatan.edit', compact('position'));
    }

    // Update data jabatan (mockup untuk contoh)
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'baseSalary' => 'required|numeric',
            'transportAllowance' => 'required|numeric',
            'mealAllowance' => 'required|numeric',
        ]);

        // Logika update jabatan (mockup untuk contoh, sesuaikan dengan database)
        // $position = Jabatan::findOrFail($id);
        // $position->update([...]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diupdate.');
    }

    // Hapus data jabatan (mockup untuk contoh)
    public function destroy($id)
    {
        // Logika hapus jabatan (mockup untuk contoh, sesuaikan dengan database)
        // $position = Jabatan::findOrFail($id);
        // $position->delete();

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
