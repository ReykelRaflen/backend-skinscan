<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // ── PENTING: Jalur import token API Sanctum

class User extends Authenticatable
{
    // ── PENTING: Wajib panggil HasApiTokens di dalam use di bawah ini
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'usia',
        'jenis_kelamin',
        'foto_profile',
        'role',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel otomatis mengamankan password
    ];

    // Relasi ke Riwayat Analisis
    public function riwayats()
    {
        return $this->hasMany(Riwayat::class);
    }
}