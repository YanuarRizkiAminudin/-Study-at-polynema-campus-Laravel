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
        Schema::create('t_penjualan', function (Blueprint $table) {
            $table->id('penjualan_id'); // Primary key auto-increment
            $table->unsignedBigInteger('user_id')->index(); // Foreign key ke tabel m_user dengan index
            $table->string('pembeli', 50); // Nama pembeli dengan panjang maksimal 50 karakter
            $table->string('penjualan_kode', 20)->unique(); // Kode unik untuk setiap transaksi penjualan
            $table->dateTime('penjualan_tanggal'); // Tanggal dan waktu transaksi penjualan
            $table->timestamps(); // Kolom created_at dan updated_at otomatis

            $table->foreign('user_id')->references('user_id')->on('m_user');    // Menambahkan foreign key ke tabel m_user
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan');     // Menghapus tabel jika rollback dijalankan
    }
};
