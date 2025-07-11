<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPenjaluran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'id_jalur',
        'skor_akhir',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function jalur()
    {
        return $this->belongsTo(Jalur::class, 'id_jalur', 'id_jalur');
    }
}
