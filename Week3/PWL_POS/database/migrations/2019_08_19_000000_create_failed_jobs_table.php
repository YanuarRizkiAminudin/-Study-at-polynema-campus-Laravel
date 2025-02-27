<?php

// Menggunakan kelas yang diperlukan untuk migration
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Mengembalikan instance anonim dari kelas Migration
return new class extends Migration
{
    /**
     * Menjalankan migration untuk membuat tabel failed_jobs
     */
    public function up(): void
    {
        // Membuat tabel failed_jobs untuk menyimpan pekerjaan yang gagal dieksekusi
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key (auto increment)
            $table->string('uuid')->unique(); // Kolom uuid sebagai identifier unik untuk setiap job yang gagal
            $table->text('connection'); // Kolom untuk menyimpan nama koneksi database
            $table->text('queue'); // Kolom untuk menyimpan nama queue yang digunakan
            $table->longText('payload'); // Kolom untuk menyimpan data pekerjaan yang gagal
            $table->longText('exception'); // Kolom untuk menyimpan pesan error dari pekerjaan yang gagal
            $table->timestamp('failed_at')->useCurrent(); // Kolom untuk mencatat waktu kegagalan secara otomatis
        });
    }

    /**
     * Mengembalikan perubahan (menghapus tabel jika diperlukan)
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs'); // Menghapus tabel jika ada
    }
};
