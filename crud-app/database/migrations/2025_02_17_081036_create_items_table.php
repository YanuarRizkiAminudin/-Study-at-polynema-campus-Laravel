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
        Schema::create('items', function (Blueprint $table) {
            $table->id();               // ID kolom primary key
            $table->string('name');      // Kolom untuk nama item
            $table->text('description'); // Kolom untuk deskripsi item
            $table->timestamps();       // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');// Menghapus tabel items jika migrasi dibatalkan
    }
};
