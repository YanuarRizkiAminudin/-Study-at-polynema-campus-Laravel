<?php

// Menggunakan kelas yang diperlukan untuk migration
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Mengembalikan instance anonim dari kelas Migration
return new class extends Migration
{
    /**
     * Menjalankan migration untuk membuat tabel users
     */
    public function up(): void
    {
        // Membuat tabel users
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key (auto increment)
            $table->string('name'); // Kolom untuk menyimpan nama pengguna
            $table->string('email')->unique(); // Kolom email yang harus unik
            $table->timestamp('email_verified_at')->nullable(); // Kolom untuk menyimpan waktu verifikasi email (bisa kosong)
            $table->string('password'); // Kolom untuk menyimpan kata sandi
            $table->rememberToken(); // Kolom untuk menyimpan token "remember me"
            $table->timestamps(); // Kolom created_at dan updated_at untuk mencatat waktu perubahan data
        });
    }

    /**
     * Mengembalikan perubahan (menghapus tabel jika diperlukan)
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Menghapus tabel jika ada
    }
};
