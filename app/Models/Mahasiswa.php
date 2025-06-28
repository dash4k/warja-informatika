<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'int';


    protected $fillable = [
        "nim",
        "nama",
        "kelas",
        "profile_picture",
    ];

    public function progress()
    {
        return $this->hasOne(Progress::class, 'nim', 'nim');
    }

    public function jumlahPortofolio()
    {
        return $this->hasOne(JumlahPortofolio::class, 'nim', 'nim');
    }
}
