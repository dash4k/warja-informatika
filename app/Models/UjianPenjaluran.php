<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianPenjaluran extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'deskripsi',
        'durasi_ujian',
        'tanggal_mulai',
        'waktu_mulai',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'tanggal_mulai' => 'date',
    ];

    public function ujianMahasiswa()
    {
        return $this->hasMany(UjianMahasiswa::class, 'id_ujian', 'id');
    }
    
    public function soalUjian()
    {
        return $this->hasMany(SoalUjianMahasiswa::class, 'id_ujian', 'id');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanUjianMahasiswa::class, 'id_ujian', 'id');
    }
}
