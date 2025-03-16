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
        Schema::create('t_penjualan_detail', function (Blueprint $table) {
            $table->id('detail_id'); // Primary key auto-increment
            $table->unsignedBigInteger('penjualan_id')->index(); // Foreign key ke tabel t_penjualan
            $table->unsignedBigInteger('barang_id')->index(); // Foreign key ke tabel m_barang
            $table->integer('harga'); // Harga jual barang saat transaksi
            $table->integer('jumlah'); // Jumlah barang yang dibeli
            $table->timestamps(); // Kolom created_at dan updated_at otomatis

            $table->foreign('penjualan_id')->references('penjualan_id')->on('t_penjualan'); // Menambahkan foreign key ke tabel t_penjualan
            $table->foreign('barang_id')->references('barang_id')->on('m_barang');  // Menambahkan foreign key ke tabel m_barang

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('t_penjualan_detail'); // Menghapus tabel jika rollback dijalankan
    }
};
