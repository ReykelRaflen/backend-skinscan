<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    protected $fillable = ['label_kulit', 'tingkat_urgensi', 'tips_perawatan'];
}
