<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalPenjaluran extends Model
{
    use HasFactory;

    protected $casts = [
        'pilihan' => 'array',
    ];

    protected $fillable = [
        'id_jalur',
        'pertanyaan',
        'pilihan',
        'jawaban',
    ];

    public function jalur()
    {
        return $this->belongsTo(Jalur::class, 'id_jalur', 'id_jalur');
    }

    public function soalUjian()
    {
        return $this->hasMany(SoalUjianMahasiswa::class, 'id_soal', 'id');
    }
}
