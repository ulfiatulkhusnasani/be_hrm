<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_karyawan',
        'tanggal_lembur',
        'jam_lembur',
        'upah_lembur',
    ];
}
