<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level';
    protected $primaryKey = 'level_id';


protected $fillable = ['level_nama', 'level_nama']; // Sesuaikan dengan kolom yang ada di tabel m_level
public function user(): HasMany
{
    return $this->hasMany(UserModel::class, 'level_id', 'level_id');
}
}