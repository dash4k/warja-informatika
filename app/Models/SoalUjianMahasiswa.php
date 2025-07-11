<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalUjianMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ujian_mahasiswa',
        'id_soal',
        'id_jalur',
    ];

    public function ujian()
    {
        return $this->belongsTo(UjianMahasiswa::class, 'id_ujian_mahasiswa', 'id');
    }

    public function soal()
    {
        return $this->belongsTo(SoalPenjaluran::class, 'id_soal', 'id');
    }

    public function jalur()
    {
        return $this->belongsTo(Jalur::class, 'id_jalur', 'id_jalur');
    }

    public function jawaban()
    {
        return $this->hasOne(JawabanUjianMahasiswa::class, 'id_soal', 'id');
    }
}
