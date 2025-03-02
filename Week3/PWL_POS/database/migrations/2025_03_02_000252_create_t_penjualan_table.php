<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('t_penjualan', function (Blueprint $table) {
            $table->id(); // Primary key (auto-increment)
            $table->dateTime('tgl_penjualan'); // Tanggal penjualan
            $table->integer('total_bayar');    // Total bayar
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_penjualan');
    }
};
