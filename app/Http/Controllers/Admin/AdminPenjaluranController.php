<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilPenjaluran;
use App\Models\SurveyJalur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPenjaluranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hasilPenjalurans = HasilPenjaluran::get()->groupBy('id_jalur');
        if ($hasilPenjalurans->isEmpty()) {
            return view('admin.empty-hasil');
        } else {
            return view('admin.hasil',compact('hasilPenjalurans'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jalurNilais = $this->getJalurNilaiMapping();
        $jalurOrder = $this->getOrderedJalurSurvey();
        $nilais = $this->getNilaiData();
        $ujians = $this->getUjianData();
        $portofolios = $this->getPortofolioData();
        $mahasiswaList = $this->getMahasiswaList();

        $results = $this->calculateScores($mahasiswaList, $nilais, $ujians, $portofolios, $jalurNilais);
        $finalAssignments = $this->assignMahasiswaToJalur($results, $jalurOrder);

        DB::table('hasil_penjalurans')->upsert(
            $finalAssignments,
            ['nim'],
            ['id_jalur', 'skor_akhir', 'updated_at']
        );

        return redirect()->route('admin.penjaluran.index')
            ->with('success', 'Penjaluran created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showPenjaluran()
    {
        $surveys = SurveyJalur::get();

        $jumlahPerJalur = SurveyJalur::selectRaw('id_jalur, COUNT(*) as jumlah')->groupBy('id_jalur')->pluck('jumlah', 'id_jalur');

        $surveysPerJalur = $surveys->groupBy('id_jalur')->map->values();

        $leaderboards = DB::table('jawaban_ujian_mahasiswas as j')
            ->join('soal_ujian_mahasiswas as su', 'j.id_soal', '=', 'su.id')
            ->join('ujian_mahasiswas as uj', 'su.id_ujian_mahasiswa', '=', 'uj.id')
            ->join('mahasiswas as m', 'uj.nim', '=', 'm.nim')
            ->select('su.id_jalur', 'm.nim', 'm.nama', DB::raw('COUNT(*) as total_benar'))
            ->where('j.is_correct', true)
            ->groupBy('su.id_jalur', 'm.nim', 'm.nama')
            ->orderByDesc('total_benar')
            ->get()
            ->groupBy('id_jalur')
            ->map(fn ($group) => $group->sortByDesc('total_benar')->values()->take(3));

        return view('admin.penjaluran', compact('surveys', 'jumlahPerJalur', 'surveysPerJalur', 'leaderboards'));
    }

    private function getJalurNilaiMapping(): array
    {
        return [
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
    }

    private function getOrderedJalurSurvey(): array
    {
        return DB::table('survey_jalurs')
            ->select(DB::raw('LOWER(id_jalur) as id_jalur'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('LOWER(id_jalur)'))
            ->orderByDesc('total')
            ->pluck('id_jalur')
            ->toArray();
    }

    private function getNilaiData()
    {
        return DB::table('nilais')->get()->keyBy('id_nilai');
    }

    private function getUjianData()
    {
        return DB::table('jawaban_ujian_mahasiswas')
            ->join('ujian_mahasiswas', 'jawaban_ujian_mahasiswas.id_ujian_mahasiswa', '=', 'ujian_mahasiswas.id')
            ->select('ujian_mahasiswas.nim', DB::raw('SUM(jawaban_ujian_mahasiswas.is_correct) as total_benar'), DB::raw('COUNT(*) as total_soal'))
            ->groupBy('ujian_mahasiswas.nim')
            ->get()
            ->keyBy('nim');
    }

    private function getPortofolioData()
    {
        return DB::table('portofolios')
            ->where('validated', true)
            ->get()
            ->groupBy(fn($p) => $p->nim . '-' . $p->jalur);
    }

    private function getMahasiswaList()
    {
        return DB::table('mahasiswas')->get();
    }

    private function calculateScores($mahasiswaList, $nilais, $ujians, $portofolios, $jalurNilais): array
    {
        $results = [];

        foreach ($mahasiswaList as $mhs) {
            $nim = $mhs->nim;
            $nilai = $nilais[$nim] ?? null;
            $ujian = $ujians[$nim] ?? null;

            if (!$nilai || !$ujian) continue;

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

        return $results;
    }

    private function assignMahasiswaToJalur(array $results, array $jalurOrder): array
    {
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
                        'id_jalur' => strtoupper($jalur),
                        'skor_akhir' => $candidate['score'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        return $finalAssignments;
    }

}
