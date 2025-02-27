<?php

// Menggunakan kelas yang diperlukan untuk migration
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Mengembalikan instance anonim dari kelas Migration
return new class extends Migration
{
    /**
     * Menjalankan migration untuk membuat tabel m_level
     */
    public function up(): void
    {
        // Membuat tabel m_level untuk menyimpan data level pengguna atau akses
        Schema::create('m_level', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key (auto increment)
            $table->string('level_kode', 10)->unique(); // Kolom kode level dengan panjang maksimal 10 karakter dan harus unik
            $table->string('level_nama', 100); // Kolom untuk menyimpan nama level dengan panjang maksimal 100 karakter
            $table->timestamps(); // Kolom created_at dan updated_at untuk mencatat waktu perubahan data
        });
    }

    /**
     * Mengembalikan perubahan (menghapus tabel jika diperlukan)
     */
    public function down(): void
    {
        Schema::dropIfExists('m_level'); // Menghapus tabel jika ada
    }
};
