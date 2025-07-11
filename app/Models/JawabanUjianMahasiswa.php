<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanUjianMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ujian_mahasiswa',
        'id_soal',
        'jawaban',
        'is_correct',
    ];

    public function ujian()
    {
        return $this->belongsTo(UjianMahasiswa::class, 'id_ujian_mahasiswa', 'id');
    }

    public function soal()
    {
        return $this->belongsTo(SoalUjianMahasiswa::class, 'id_soal', 'id');
    }
}
