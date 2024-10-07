<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KaryawanController;

// Public routes
Route::post('register',[App\Http\Controllers\Authcontroller::class,'register']);
Route::post('login',[App\Http\Controllers\Authcontroller::class,'login']);

// Routes that require authentication using Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [App\Http\Controllers\Authcontroller::class, 'user']);
    Route::post('logout', [Authcontroller::class, 'logout']);

});

    // Rute untuk AbsensiController
    Route::post('/absensi', [AbsensiController::class, 'store']);
    Route::get('/absensi', [AbsensiController::class, 'index']);
    Route::get('/absensi/{id}', [AbsensiController::class, 'show']);
    Route::put('/absensi/{id}', [AbsensiController::class, 'update']);
    Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy']);
    // Rute untuk KaryawanController
    Route::post('/karyawan/created', [KaryawanController::class, 'store']);
    Route::get('/karyawan', [KaryawanController::class, 'index']); 
    Route::get('/karyawan/{id}', [KaryawanController::class, 'show']); // Menampilkan detail karyawan
    Route::put('/karyawan/{id}', [KaryawanController::class, 'update']); // Update data karyawan
    Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy']); // Hapus karyawan

    // Jika ingin menggunakan resource route bisa tambahkan ini (Opsional)
    // Route::resource('karyawan', KaryawanController::class);
