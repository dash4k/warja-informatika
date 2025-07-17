<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $primaryKey = 'nim';

    public $incrementing = false;
    
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'progress_umum',
        'progress_nilai',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
