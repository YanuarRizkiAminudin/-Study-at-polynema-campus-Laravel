<?php

// Menggunakan kelas yang diperlukan untuk migration
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Mengembalikan instance anonim dari kelas Migration
return new class extends Migration
{
    /**
     * Menjalankan migration untuk membuat tabel personal_access_tokens
     */
    public function up(): void
    {
        // Membuat tabel personal_access_tokens untuk menyimpan token akses pribadi
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key (auto increment)
            $table->morphs('tokenable'); // Kolom polymorphic untuk relasi ke model lain
            $table->string('name'); // Kolom untuk menyimpan nama token
            $table->string('token', 64)->unique(); // Kolom token unik dengan panjang 64 karakter
            $table->text('abilities')->nullable(); // Kolom untuk menyimpan hak akses token (opsional)
            $table->timestamp('last_used_at')->nullable(); // Kolom untuk mencatat waktu terakhir token digunakan
            $table->timestamp('expires_at')->nullable(); // Kolom untuk mencatat waktu kedaluwarsa token (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at untuk mencatat waktu perubahan data
        });
    }

    /**
     * Mengembalikan perubahan (menghapus tabel jika diperlukan)
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens'); // Menghapus tabel jika ada
    }
};
