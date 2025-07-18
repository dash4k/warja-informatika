<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        "nim",
        "nama",
        "kelas",
        "profile_picture",
        "validated",
        "validated_at",
        "admin_notes",
        "id_admin",
    ];

    public function progress()
    {
        return $this->hasOne(Progress::class, 'nim', 'nim');
    }

    public function jumlahPortofolio()
    {
        return $this->hasOne(JumlahPortofolio::class, 'nim', 'nim');
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class, 'id_nilai', 'nim');
    }

    public function portofolio()
    {
        return $this->hasMany(Portofolio::class, 'nim', 'nim');
    }

    public function ujianMahasiswa()
    {
        return $this->hasOne(UjianMahasiswa::class, 'nim', 'nim');
    }

    public function survey()
    {
        return $this->hasOne(SurveyJalur::class, 'nim', 'nim');
    }

    public function hasilPenjaluran()
    {
        return $this->hasOne(HasilPenjaluran::class, 'nim', 'nim');
    }
}
