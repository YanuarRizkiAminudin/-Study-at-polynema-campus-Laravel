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
         // Membuat tabel password_reset_tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) { 
            $table->string('email')->primary(); // Kolom email sebagai primary key
            $table->string('token'); // Kolom untuk menyimpan token reset password
            $table->timestamp('created_at')->nullable(); // Kolom untuk menyimpan waktu pembuatan 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens'); // Menghapus tabel jika ada
    }
};
