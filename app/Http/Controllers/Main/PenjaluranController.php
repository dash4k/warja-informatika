<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\HasilPenjaluran;
use App\Models\Jalur;
use App\Models\JawabanUjianMahasiswa;
use App\Models\SoalUjianMahasiswa;
use App\Models\UjianMahasiswa;
use App\Models\UjianPenjaluran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PenjaluranController extends Controller
{
    // View method
    public function index()
    {
        $hasil = HasilPenjaluran::with('mahasiswa', 'jalur')
            ->where('nim', Auth::user()->id_user)
            ->first();
        return view('main.penjaluran', compact('hasil'));
    }

    public function unvalidated()
    {
        return view('penjaluran.unvalidated');
    }

    public function survey()
    {
        $jalurs = Jalur::get();
        return view('penjaluran.survey', compact('jalurs'));
    }

    public function waiting()
    {
        return view('penjaluran.waiting');
    }

    public function countdown()
    {
        $ujian = UjianMahasiswa::with('ujian')
            ->where('nim', Auth::user()->id_user)
            ->first();
        return view('penjaluran.countdown', compact('ujian'));
    }

    public function exam(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $ujianMahasiswa = $mahasiswa->ujianMahasiswa;

        $soals = SoalUjianMahasiswa::where('id_ujian_mahasiswa', $ujianMahasiswa->id)
            ->with('soal')
            ->paginate(10);

        $ujian = $ujianMahasiswa->ujian;
        $startDateTime = Carbon::parse($ujianMahasiswa->waktu_mulai);
        $durasi = (int) ($ujianMahasiswa->ujian->durasi_ujian ?? 0);
        $endDateTime = $startDateTime->copy()->addMinutes($durasi);

        return view('penjaluran.exam', compact('soals', 'endDateTime'));
    }

    public function start()
    {
        $ujian = UjianMahasiswa::with('ujian')
            ->where('nim', Auth::user()->id_user)
            ->first();
        return view('penjaluran.start', compact('ujian'));
    }

    public function redirect()
    {
        $user = Auth::user()->mahasiswa;
        $mahasiswa = $user->load('nilai', 'portofolio', 'survey', 'ujianMahasiswa', 'hasilPenjaluran');

        $allValidated = $mahasiswa->portofolio ? $mahasiswa->portofolio->every(fn($p) => $p->validated) : true;

        if (
            !$mahasiswa->validated ||
            !$mahasiswa->nilai->validated ||
            !$allValidated
        ) {
            return redirect()->route('penjaluran.unvalidated');
        }

        if (!$mahasiswa->survey) {
            return redirect()->route('penjaluran.survey');
        }

        if (!$mahasiswa->ujianMahasiswa) {
            return redirect()->route('penjaluran.waiting');
        }

        $ujianPenjaluran = $mahasiswa->ujianMahasiswa->ujian;

        $tanggal = Carbon::parse($ujianPenjaluran->tanggal_mulai)->format('Y-m-d');
        $waktu = Carbon::parse($ujianPenjaluran->waktu_mulai)->format('H:i:s');
        $startDateTime = Carbon::parse("$tanggal $waktu");

        $durasi = intval($ujianPenjaluran->durasi_ujian);
        $endDateTime = $startDateTime->copy()->addMinutes($durasi);

        $now = now(); 

        if (!$mahasiswa->hasilPenjaluran) {
            if ($mahasiswa->ujianMahasiswa->waktu_selesai === null) {
                if ($now->between($startDateTime, $endDateTime)) {
                    return redirect()->route('penjaluran.start');
                } else {
                    return redirect()->route('penjaluran.countdown');
                } 
            }
            else {
                return redirect()->route('penjaluran.waiting');
            }
        } else {
            return redirect()->route('penjaluran');
        }

    }

    public function startExam()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $ujianMahasiswa = UjianMahasiswa::where('nim', $mahasiswa->nim)->firstOrFail();

        $ujianMahasiswa->waktu_mulai = now();
        $ujianMahasiswa->save();

        return redirect()->route('penjaluran.exam');
    }

    public function saveAnswer(Request $request)
    {
        $data = $request->input('answers');
        $currentPage = (int) $request->input('current_page', 1);
        $action = $request->input('action');

        if (is_array($data)) {
            foreach ($data as $soalId => $answer) {
                $soalUjian = SoalUjianMahasiswa::find($soalId);
                if (!$soalUjian) continue;

                $soal = $soalUjian->soal;
                $isCorrect = $soal->jawaban === $answer;

                JawabanUjianMahasiswa::updateOrCreate(
                    [
                        'id_ujian_mahasiswa' => $soalUjian->id_ujian_mahasiswa,
                        'id_soal' => $soalUjian->id,
                    ],
                    [
                        'jawaban' => $answer,
                        'is_correct' => $isCorrect,
                    ]
                );
            }
        }

        if ($action === 'previous') {
            $page = max($currentPage - 1, 1);
            return redirect()->route('penjaluran.exam', ['page' => $page]);
        }

        if ($action === 'next') {
            $page = $currentPage + 1;
            return redirect()->route('penjaluran.exam', ['page' => $page]);
        }

        if ($action === 'submit') {
            $ujian = Auth::user()->mahasiswa->ujianMahasiswa;

            $ujian->waktu_selesai = now();
            $ujian->save();
            
            return redirect()->route('penjaluran.waiting')->with('success', 'Exam submitted successfully.');
        }

        return redirect()->route('penjaluran.exam', ['page' => $currentPage]);
    }

}
