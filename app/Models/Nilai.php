<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_nilai';

    public $incrementing = false;
    
    protected $keyType = 'string';

    protected $fillable = [
        'id_nilai',
        'etika_profesi',
        'kewarganegaraan',
        'bahasa_indonesia',
        'matematika_diskrit_1',
        'statistika_dasar',
        'algoritma_pemrograman',
        'sistem_digital',
        'matematika_informatika',
        'pancasila',
        'pendidikan_agama',
        'matematika_diskrit_2',
        'pengantar_probabilitas',
        'kewirausahaan',
        'tata_tulis_karya_ilmiah',
        'struktur_data',
        'sistem_operasi',
        'organisasi_arsitektur_komputer',
        'interaksi_manusia_komputer',
        'basis_data',
        'desain_analisis_algoritma',
        'rekayasa_perangkat_lunak',
        'pemrograman_berorientasi_obyek',
        'komunikasi_data_jaringan_komputer',
        'teori_bahasa_otomata',
        'transkrip_sementara',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_nilai', 'nim');
    }
}
