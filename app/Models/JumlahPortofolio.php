<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JumlahPortofolio extends Model
{
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        "nim",
        "j1",
        "j2",
        "j3",
        "j4",
        "j5",
        "j6",
        "j7",
        "j8",
        "j9",
    ];
}
