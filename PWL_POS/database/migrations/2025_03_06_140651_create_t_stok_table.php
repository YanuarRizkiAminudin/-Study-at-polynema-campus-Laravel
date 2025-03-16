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
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id('stok_id'); // Primary key auto-increment
            $table->unsignedBigInteger('barang_id')->index(); // Foreign key ke tabel m_barang dengan index
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel m_user
            $table->dateTime('stok_tanggal'); // Tanggal dan waktu transaksi stok
            $table->integer('stok_jumlah'); // Jumlah stok yang ditambahkan atau dikurangi
            $table->timestamps(); // Kolom created_at dan updated_at otomatis

            $table->foreign('barang_id')->references('barang_id')->on('m_barang');  // Menambahkan foreign key ke tabel m_barang
            $table->foreign('user_id')->references('user_id')->on('m_user');    // Menambahkan foreign key ke tabel m_user

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_stok'); // Menghapus tabel jika rollback dijalankan
    }
};