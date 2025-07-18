<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilPenjaluran;
use App\Models\SurveyJalur;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AdminPenjaluranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $angkatan = HasilPenjaluran::selectRaw('LEFT(nim, 2) as prefix')
            ->distinct()
            ->orderByDesc('prefix')
            ->pluck('prefix')
            ->map(function ($prefix) {
                return '20' . $prefix;
            });

        if ($angkatan->isEmpty()) {
            return view('admin.empty-hasil');
        }

        return view('admin.hasil-list', compact('angkatan'));
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
        $request->validate([
            'tahun' => 'required|string|max:2',
        ]);

        $angkatan = $request->input('tahun') . '%';

        $mahasiswaList = $this->getMahasiswaList($angkatan);

        // handle empty result here
        if ($mahasiswaList->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data mahasiswa untuk angkatan tersebut!');
        }

        if (HasilPenjaluran::where('nim', 'like', $angkatan)->exists()) {
            return redirect()->back()->with('error', 'Data penjaluran untuk angkatan ini sudah ada!');
        }

        $jalurNilais = $this->getJalurNilaiMapping();
        $jalurOrder = $this->getOrderedJalurSurvey($angkatan);
        $nilais = $this->getNilaiData($angkatan);
        $ujians = $this->getUjianData($angkatan);
        $portofolios = $this->getPortofolioData($angkatan);

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
    public function show($angkatan)
    {
        $prefix = substr($angkatan, 2); // e.g., 2023 → 23

        $hasilPenjalurans = HasilPenjaluran::where('nim', 'like', $prefix . '%')
            ->get()
            ->groupBy('id_jalur');

        if ($hasilPenjalurans->isEmpty()) {
            return view('admin.empty-hasil', compact('year'));
        }

        return view('admin.hasil', compact('hasilPenjalurans', 'angkatan'));
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

    public function showPenjaluran(Request $request)
    {
        $angkatanList = DB::table('mahasiswas')
            ->selectRaw('SUBSTRING(nim, 1, 2) as tahun')
            ->distinct()
            ->pluck('tahun');

        $tahun = $request->input('tahun') ?? $angkatanList->min() ?? date('y');
        $tahunLike = $tahun . '%';

        $surveys = SurveyJalur::whereHas('mahasiswa', function ($query) use ($tahunLike) {
            $query->where('nim', 'like', $tahunLike);
        })->get();

        $jumlahPerJalur = SurveyJalur::whereHas('mahasiswa', function ($query) use ($tahunLike) {
            $query->where('nim', 'like', $tahunLike);
        })
        ->selectRaw('id_jalur, COUNT(*) as jumlah')
        ->groupBy('id_jalur')
        ->pluck('jumlah', 'id_jalur');

        $surveysPerJalur = $surveys->groupBy('id_jalur')->map->values();

        $leaderboards = DB::table('jawaban_ujian_mahasiswas as j')
            ->join('soal_ujian_mahasiswas as su', 'j.id_soal', '=', 'su.id')
            ->join('ujian_mahasiswas as uj', 'su.id_ujian_mahasiswa', '=', 'uj.id')
            ->join('mahasiswas as m', 'uj.nim', '=', 'm.nim')
            ->select('su.id_jalur', 'm.nim', 'm.nama', DB::raw('COUNT(*) as total_benar'))
            ->where('j.is_correct', true)
            ->where('m.nim', 'like', $tahunLike)
            ->groupBy('su.id_jalur', 'm.nim', 'm.nama')
            ->orderByDesc('total_benar')
            ->get()
            ->groupBy('id_jalur')
            ->map(fn ($group) => $group->sortByDesc('total_benar')->values()->take(3));

        return view('admin.penjaluran', compact('surveys', 'jumlahPerJalur', 'surveysPerJalur', 'leaderboards', 'tahun', 'angkatanList'));
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

    private function getOrderedJalurSurvey($angkatan): array
    {
        return DB::table('survey_jalurs')
            ->select(DB::raw('LOWER(id_jalur) as id_jalur'), DB::raw('COUNT(*) as total'))
            ->where('nim', 'like', $angkatan)
            ->groupBy(DB::raw('LOWER(id_jalur)'))
            ->orderByDesc('total')
            ->pluck('id_jalur')
            ->toArray();
    }

    private function getNilaiData($angkatan)
    {
        return DB::table('nilais')->where('id_nilai', 'like', $angkatan)->get()->keyBy('id_nilai');
    }

    private function getUjianData($angkatan)
    {
        return DB::table('jawaban_ujian_mahasiswas')
            ->join('ujian_mahasiswas', 'jawaban_ujian_mahasiswas.id_ujian_mahasiswa', '=', 'ujian_mahasiswas.id')
            ->where('ujian_mahasiswas.nim', 'like', $angkatan)
            ->select('ujian_mahasiswas.nim', DB::raw('SUM(jawaban_ujian_mahasiswas.is_correct) as total_benar'), DB::raw('COUNT(*) as total_soal'))
            ->groupBy('ujian_mahasiswas.nim')
            ->get()
            ->keyBy('nim');
    }

    private function getPortofolioData($angkatan)
    {
        return DB::table('portofolios')
            ->where('validated', true)
            ->where('nim', 'like', $angkatan)
            ->get()
            ->groupBy(fn($p) => $p->nim . '-' . $p->jalur);
    }

    private function getMahasiswaList($tahun)
    {
        return DB::table('mahasiswas')->where('nim', 'like', $tahun)->get();
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
                        'nim' => (string) $candidate['nim'],
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

    public function downloadPdf($angkatan)
    {
        $jumlahPerJalur = SurveyJalur::selectRaw('id_jalur, COUNT(*) as jumlah')->groupBy('id_jalur')->where('nim', 'like', $angkatan . '%')->pluck('jumlah', 'id_jalur');
        $hasilPenjalurans = HasilPenjaluran::where('nim', 'like', $angkatan . '%')->get()->groupBy('id_jalur');
        $tahunFormatted = '20' . $angkatan;

        if ($hasilPenjalurans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data hasil penjaluran untuk angkatan ini.');
        }

        $labels = ['J1', 'J2', 'J3', 'J4', 'J5', 'J6', 'J7', 'J8', 'J9'];
        $data = array_map(fn($jalur) => $jumlahPerJalur[$jalur] ?? 0, $labels);

        $chartConfig = [
            'type' => 'pie',
            'data' => [
                'labels' => $labels,
                'datasets' => [[
                    'data' => $data,
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                        '#9966FF', '#FF9F40', '#C9CBcf', '#8A2BE2', '#00B894'
                    ]
                ]]
            ],
            'options' => [
                'plugins' => [
                    'legend' => ['position' => 'right']
                ]
            ]
        ];

        $chartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode($chartConfig));

        // Download and convert to base64
        $response = Http::get($chartUrl);

        if ($response->ok()) {
            $chartBase64 = 'data:image/png;base64,' . base64_encode($response->body());
        } else {
            $chartBase64 = null;
        }

        $pdf = PDF::loadView('admin.penjaluran-pdf', [
            'hasilPenjalurans' => $hasilPenjalurans,
            'angkatan' => $tahunFormatted,
            'chartBase64' => $chartBase64,
            'jumlahPerJalur' => $jumlahPerJalur,
        ]);

        return $pdf->download('hasil-penjaluran-' . $angkatan . '.pdf');
    }
}