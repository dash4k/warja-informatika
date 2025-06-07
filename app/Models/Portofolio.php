<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_portofolio';

    protected $fillable = [
        'nim',
        'tanggal_mulai',
        'tanggal_berakhir',
        'nama_kegiatan',
        'tempat_kegiatan',
        'bukti',
        'bobot',
        'status',
        'action',
    ];
}
