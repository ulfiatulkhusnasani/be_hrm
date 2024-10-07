<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans'; // Sesuaikan dengan nama tabel

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'nama_karyawan',
        'nik',
        'email',
        'no_handphone',
        'alamat',
        'password'
    ];
}