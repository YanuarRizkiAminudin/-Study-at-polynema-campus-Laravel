<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('m_user', function (Blueprint $table) {
            // Menggunakan user_id sebagai primary key (tanpa auto-increment agar sesuai dengan seeder)
            $table->integer('user_id')->primary();
            $table->unsignedBigInteger('level_id');
            $table->string('username', 50)->unique();
            $table->string('nama', 100);
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
};
