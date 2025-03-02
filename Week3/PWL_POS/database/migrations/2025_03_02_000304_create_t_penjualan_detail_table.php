<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('t_penjualan_detail', function (Blueprint $table) {
            $table->id(); // Primary key (auto-increment)
            $table->unsignedBigInteger('penjualan_id'); // Relasi ke t_penjualan
            $table->unsignedBigInteger('barang_id');    // Relasi ke m_barang
            $table->integer('qty');                       // Jumlah barang yang terjual
            $table->integer('subtotal');                  // Subtotal harga
            $table->timestamps();

            // Menambahkan foreign key untuk penjualan_id dan barang_id
            $table->foreign('penjualan_id')
                  ->references('id')
                  ->on('t_penjualan')
                  ->onDelete('cascade');
            $table->foreign('barang_id')
                  ->references('id')
                  ->on('m_barang')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_penjualan_detail');
    }
};
