<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalur extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jalur';
    public $incrementing = false;
    protected $keyType = 'string';

    public function soalPenjaluran()
    {
        return $this->hasMany(SoalPenjaluran::class, 'id_jalur', 'id_jalur');
    }

    public function soalMahasiswa()
    {
        return $this->hasMany(SoalUjianMahasiswa::class, 'id_jalur', 'id_jalur');
    }

    public function survey()
    {
        return $this->hasMany(SurveyJalur::class, 'id_jalur', 'id_jalur');
    }

    public function hasilPenjaluran()
    {
        return $this->hasMany(HasilPenjaluran::class, 'id_jalur', 'id_jalur');
    }
}
