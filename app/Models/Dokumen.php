<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'nama_dokumen',
        'file_path',
        'kategori_dokumen'
    ];

    /**
     * Relasi ke User (1 user bisa memiliki banyak dokumen)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
