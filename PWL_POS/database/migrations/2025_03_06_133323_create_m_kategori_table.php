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
        Schema::create('m_kategori', function (Blueprint $table) {
            $table->id('kategori_id'); // Kolom primary key dengan auto-increment
            $table->string('kategori_kode', 10); // Kolom kode kategori dengan panjang maksimal 10 karakter
            $table->string('kategori_nama', 100); // Kolom nama kategori dengan panjang maksimal 100 karakter
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_kategori', function (Blueprint $table) {   // Menghapus tabel jika rollback dijalankan
            //
        });
    }
};
