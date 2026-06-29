<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $fillable = ['user_id', 'rekomendasi_id', 'hasil_label', 'skor_akurasi', 'path_gambar', 'all_scores', 'catatan', 'tgl_analisis'];

    protected $casts = [
        'all_scores' => 'array',
        'tgl_analisis' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rekomendasi()
    {
        return $this->belongsTo(Rekomendasi::class);
    }
}
