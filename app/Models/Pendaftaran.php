<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'nama',
        'nisn',
        'nik',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'asal_sekolah',
        'notelp',
        'nilai_rata_rata',
        'status_pendaftaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
