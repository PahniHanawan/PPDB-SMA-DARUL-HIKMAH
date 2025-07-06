<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke Pendaftaran (1 user hanya bisa daftar 1 kali)
     */
    public function pendaftaran(): HasOne
    {
        return $this->hasOne(Pendaftaran::class, 'id_user');
    }

    /**
     * Relasi ke Orangtua (1 user hanya punya 1 data orang tua)
     */
    public function orangtua(): HasOne
    {
        return $this->hasOne(Orangtua::class, 'id_user');
    }

    /**
     * Relasi ke Dokumen (1 user bisa upload banyak dokumen)
     */
    public function dokumen(): HasMany
    {
        return $this->hasMany(Dokumen::class, 'id_user');
    }
}
