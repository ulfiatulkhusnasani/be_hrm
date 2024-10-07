<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    // Menambahkan kolom yang dapat diisi
    protected $fillable = [
        'name',           // Nama Karyawan
        'nik',            // NIK
        'email',          // Email
        'noHandphone',    // Nomor Handphone
        'alamat',         // Alamat
        'password',       // Kata Sandi
    ];

    protected $hidden = [
        'password',       // Sembunyikan password
        'remember_token', // Sembunyikan remember token (jika ada)
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', // Cast tanggal verifikasi email
    ];
}
