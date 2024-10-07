<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Karyawan
            $table->string('nik')->unique(); // NIK
            $table->string('noHandphone'); // Nomor Handphone
            $table->string('alamat'); // Alamat
            $table->string('email')->unique(); // Email
            $table->timestamp('email_verified_at')->nullable(); // Tanggal verifikasi email
            $table->string('password'); // Kata Sandi
            $table->rememberToken(); // Token untuk 'remember me'
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
