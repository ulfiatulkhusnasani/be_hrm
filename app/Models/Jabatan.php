<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan'; // Sesuaikan dengan nama tabel yang kamu gunakan
    
    protected $fillable = ['nama', 'deskripsi']; // Sesuaikan dengan kolom di tabel jabatan
}
