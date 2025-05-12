<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transkrip_nilai extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_transkrip';

    protected $fillable = [
        'id_transkrip',
        'khs_semester_1',
        'khs_semester_2',
        'khs_semester_3',
        'transkrip_sementara',
    ];
}
