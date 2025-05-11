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
    public $timestamps = false;


    protected $fillable = [
        "nim",
        "nama",
        "kelas",
        "profile_picture",
    ];
}
