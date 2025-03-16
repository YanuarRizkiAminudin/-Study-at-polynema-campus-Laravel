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
        Schema::create('m_barang', function (Blueprint $table) {
            $table->id('barang_id'); // Kolom primary key dengan auto-increment
            $table->unsignedBigInteger('kategori_id')->index(); // Kolom kategori_id sebagai foreign key dan diberi index
            $table->string('barang_kode', 10)->unique(); // Kolom kode barang unik dengan panjang maksimal 10 karakter
            $table->string('barang_nama', 100); // Kolom nama barang dengan panjang maksimal 100 karakter
            $table->integer('harga_beli'); // Kolom harga beli
            $table->integer('harga_jual'); // Kolom harga jual
            $table->timestamps(); // Kolom created_at dan updated_at otomatis

            // Menambahkan foreign key kategori_id yang mengacu ke kategori_id di tabel m_kategori
            $table->foreign('kategori_id')->references('kategori_id')->on('m_kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_barang');   // Menghapus tabel jika rollback dijalankan
    }
};