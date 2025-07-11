<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'id_ujian',
        'waktu_mulai',
        'waktu_selesai',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function soal()
    {
        return $this->hasMany(SoalUjianMahasiswa::class, 'id_ujian_mahasiswa', 'id');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanUjianMahasiswa::class, 'id_ujian_mahasiswa', 'id');
    }

    public function ujian()
    {
        return $this->belongsTo(UjianPenjaluran::class, 'id_ujian', 'id');
    }
}