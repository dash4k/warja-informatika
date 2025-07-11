<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminProsesPenjaluranController extends Controller
{
    public function proses()
    {
        // 1. Define mapping: Jalur => relevant nilai fields
        $jalurNilais = [
            'j1' => ['teori_bahasa_otomata', 'struktur_data', 'desain_analisis_algoritma'],
            'j2' => ['basis_data', 'pemrograman_berorientasi_obyek', 'rekayasa_perangkat_lunak'],
            'j3' => ['sistem_operasi', 'organisasi_arsitektur_komputer', 'interaksi_manusia_komputer'],
            'j4' => ['statistika_dasar', 'pengantar_probabilitas', 'matematika_informatika'],
            'j5' => ['etika_profesi', 'kewirausahaan', 'tata_tulis_karya_ilmiah'],
            'j6' => ['pancasila', 'kewarganegaraan', 'pendidikan_agama'],
            'j7' => ['algoritma_pemrograman', 'struktur_data', 'sistem_digital'],
            'j8' => ['bahasa_indonesia', 'matematika_diskrit_1', 'matematika_diskrit_2'],
            'j9' => ['komunikasi_data_jaringan_komputer', 'teori_bahasa_otomata', 'interaksi_manusia_komputer'],
        ];

        // 2. Get Jalur order from survey
        $jalurOrder = DB::table('survey_jalurs')
            ->select(DB::raw('LOWER(id_jalur) as id_jalur'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('LOWER(id_jalur)'))
            ->orderByDesc('total')
            ->pluck('id_jalur')
            ->toArray();

        // 3. Load and structure all relevant data
        $nilais = DB::table('nilais')->get()->keyBy('id_nilai');
        $ujians = DB::table('jawaban_ujian_mahasiswas')
            ->join('ujian_mahasiswas', 'jawaban_ujian_mahasiswas.id_ujian_mahasiswa', '=', 'ujian_mahasiswas.id')
            ->select('ujian_mahasiswas.nim', DB::raw('SUM(jawaban_ujian_mahasiswas.is_correct) as total_benar'), DB::raw('COUNT(*) as total_soal'))
            ->groupBy('ujian_mahasiswas.nim')
            ->get()
            ->keyBy('nim');

        $portofolios = DB::table('portofolios')
            ->where('validated', true)
            ->get()
            ->groupBy(fn($p) => $p->nim . '-' . $p->jalur);

        $mahasiswaList = DB::table('mahasiswas')->get();

        // 4. Calculate skor untuk setiap mahasiswa per jalur
        $results = [];

        foreach ($mahasiswaList as $mhs) {
            $nim = $mhs->nim;
            $nilai = $nilais[$nim] ?? null;
            $ujian = $ujians[$nim] ?? null;

            if (!$nilai || !$ujian) {
                continue;
            }

            foreach ($jalurNilais as $jalur => $fields) {
                $avgNilai = collect($fields)->map(fn($f) => $nilai->$f ?? 0)->avg();
                $nilaiScore = ($avgNilai / 100) * 60;

                $ujianScore = (($ujian->total_benar ?? 0) / max($ujian->total_soal ?? 1, 1)) * 30;

                $key = "$nim-$jalur";
                $portoScore = 0;

                if (isset($portofolios[$key])) {
                    $totalBobot = $portofolios[$key]->sum('bobot');
                    $portoScore = min($totalBobot / 5, 1) * 10;
                }

                $results[$nim]['nama'] = $mhs->nama;
                $results[$nim]['scores'][$jalur] = $nilaiScore + $ujianScore + $portoScore;
            }
        }

        // 5. Alokasi mahasiswa berdasarkan skor dan preferensi survey
        $finalAssignments = [];
        $assignedNIMs = [];

        foreach ($jalurOrder as $jalur) {
            $candidates = collect($results)
                ->reject(fn($data, $nim) => in_array($nim, $assignedNIMs))
                ->map(fn($data, $nim) => [
                    'nim' => $nim,
                    'nama' => $data['nama'],
                    'score' => $data['scores'][$jalur] ?? null,
                ])
                ->filter(fn($item) => $item['score'] !== null)
                ->sortByDesc('score');

            foreach ($candidates as $candidate) {
                if (!in_array($candidate['nim'], $assignedNIMs)) {
                    $assignedNIMs[] = $candidate['nim'];
                    $finalAssignments[] = [
                        'nim' => $candidate['nim'],
                        'id_jalur' => $jalur,
                        'skor_akhir' => $candidate['score'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        // 6. Simpan hasil ke DB
        DB::table('hasil_penjalurans')->upsert(
            $finalAssignments,
            ['nim'],
            ['id_jalur', 'skor_akhir', 'updated_at']
        );

        

        // 7. Kirim ke view
        return view('admin.hasil', [
            'assignmentsByJalur' => collect($finalAssignments)->groupBy('id_jalur'),
        ]);
    }
}