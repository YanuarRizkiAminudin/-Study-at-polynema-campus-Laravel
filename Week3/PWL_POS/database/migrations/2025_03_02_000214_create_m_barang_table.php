<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('m_barang', function (Blueprint $table) {
            $table->id(); // Primary key (auto-increment kolom id)
            $table->unsignedBigInteger('kategori_id'); // Relasi ke m_kategori
            $table->string('nama_barang', 100); // Nama barang
            $table->integer('harga'); // Kolom harga
            $table->timestamps();

            // Menambahkan foreign key untuk kategori_id yang mengacu ke id di m_kategori
            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('m_kategori')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_barang');
    }
};
