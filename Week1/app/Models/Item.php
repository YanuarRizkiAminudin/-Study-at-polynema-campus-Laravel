<?php

namespace App\Models; // Mendefinisikan namespace untuk model ini agar sesuai dengan struktur Laravel

use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor trait HasFactory agar model ini bisa menggunakan factory
use Illuminate\Database\Eloquent\Model; // Mengimpor kelas Model dari Eloquent

class Item extends Model // Mendefinisikan kelas Item yang mewarisi Model bawaan Laravel
{
    use HasFactory; // Menggunakan trait HasFactory untuk model ini
    protected $fillable = ['name', 'description']; // Mendefinisikan kolom yang bisa diisi oleh mass assignment
}