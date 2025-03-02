<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id(); // Primary key (auto-increment)
            $table->unsignedBigInteger('barang_id'); // Relasi ke tabel m_barang
            $table->integer('jumlah'); // Jumlah stok
            $table->timestamps();

            // Foreign key constraint, menghubungkan barang_id dengan id di tabel m_barang
            $table->foreign('barang_id')
                  ->references('id')
                  ->on('m_barang')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_stok');
    }
};
