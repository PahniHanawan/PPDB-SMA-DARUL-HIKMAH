<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    use HasFactory;

    protected $table = 'orangtuas';
    protected $fillable = [
        'id_user',
        'nama_ayah',
        'nik_ayah',
        'status_ayah',
        'no_ayah',
        'tempat_lahir_ayah',
        'tgl_lahir_ayah',
        'agama_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nama_ibu',
        'nik_ibu',
        'status_ibu',
        'no_ibu',
        'tempat_lahir_ibu',
        'tgl_lahir_ibu',
        'agama_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'alamat_orangtua'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
