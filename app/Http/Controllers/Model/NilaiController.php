<?php

namespace App\Http\Controllers\Model;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::user()->id_user;
        $nilai = Nilai::find($userId);
        return view('main.nilai', compact('nilai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $semester)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $progression = $mahasiswa->progress;

        $nilai = Nilai::firstOrNew(['id_nilai' => $user->id_user]);

        $validated = $this->validateSemester($request, $semester);

        foreach ($validated as $key => $value) {
            $dbField = \Illuminate\Support\Str::snake($key);
            $nilai->$dbField = $value;
        }

        $nilai->save();

        $progressionMap = [1 => 2, 2 => 3, 3 => 4];
        if (isset($progressionMap[$semester])) {
            $progression->update(['progress_nilai' => $progressionMap[$semester]]);
        }

        if ($semester < 3) {
            return redirect()->route('nilai', ['semester' => $semester + 1]);
        }

        return redirect()->route('transkrip');
    }

    /**
     * Show the form to upload transkrip file.
     */
    public function transkrip()
    {
        return view('nilai.transkrip');
    }

    /**
     * Save the uploaded transkrip file.
     */
    public function saveNilai(Request $request)
    {
        $request->validate([
            'transkrip' => 'required|file|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('transkrip')->store('transkrip_files', 'public');

        $user = Auth::user();

        $nilai = Nilai::where('id_nilai', $user->id_user)->firstOrFail();

        $nilai->transkrip_sementara = $filePath;
        $nilai->save();

        $user->mahasiswa->progress->update(['progress_nilai' => 5]);

        $user->mahasiswa->progress->update(['progress_umum' => 2]);

        return redirect()->route('nilai.index')->with('success', 'Sukses menginput nilai');
    }

    /**
     * Show semester data from database instead of session.
     */
    public function show(Request $request, $semester)
    {
        $userId = Auth::user()->id_user;
        $nilai = Nilai::find($userId);

        $data = [];
        if ($nilai) {
            if ($semester == 1) {
                $data = [
                    'etikaProfesi' => $nilai->etika_profesi,
                    'kewarganegaraan' => $nilai->kewarganegaraan,
                    'bahasaIndonesia' => $nilai->bahasa_indonesia,
                    'matematikaDiskrit_1' => $nilai->matematika_diskrit_1,
                    'statistikaDasar' => $nilai->statistika_dasar,
                    'algoritmaPemrograman' => $nilai->algoritma_pemrograman,
                    'sistemDigital' => $nilai->sistem_digital,
                    'matematikaInformatika' => $nilai->matematika_informatika,
                ];
            } elseif ($semester == 2) {
                $data = [
                    'pancasila' => $nilai->pancasila,
                    'pendidikanAgama' => $nilai->pendidikan_agama,
                    'matematikaDiskrit_2' => $nilai->matematika_diskrit_2,
                    'pengantarProbabilitas' => $nilai->pengantar_probabilitas,
                    'kewirausahaan' => $nilai->kewirausahaan,
                    'tataTulisKaryaIlmiah' => $nilai->tata_tulis_karya_ilmiah,
                    'strukturData' => $nilai->struktur_data,
                    'sistemOperasi' => $nilai->sistem_operasi,
                    'organisasiArsitekturKomputer' => $nilai->organisasi_arsitektur_komputer,
                ];
            } elseif ($semester == 3) {
                $data = [
                    'interaksiManusiaKomputer' => $nilai->interaksi_manusia_komputer,
                    'basisData' => $nilai->basis_data,
                    'desainAnalisisAlgoritma' => $nilai->desain_analisis_algoritma,
                    'rekayasaPerangkatLunak' => $nilai->rekayasa_perangkat_lunak,
                    'pemrogramanBerbasisObyek' => $nilai->pemrograman_berbasis_obyek,
                    'komunikasiDataJaringanKomputer' => $nilai->komunikasi_data_jaringan_komputer,
                    'teoriBahasaOtomata' => $nilai->teori_bahasa_otomata,
                ];
            }
        }

        return view("nilai.semester{$semester}", ['data' => $data]);
    }

    /**
     * Validate semester fields.
     */
    private function validateSemester(Request $request, $semester)
    {
        $rules = [];

        if ($semester == 1) {
            $rules = [
                'etikaProfesi' => 'required|decimal:0,4',
                'kewarganegaraan' => 'required|decimal:0,4',
                'bahasaIndonesia' => 'required|decimal:0,4',
                'matematikaDiskrit_1' => 'required|decimal:0,4',
                'statistikaDasar' => 'required|decimal:0,4',
                'algoritmaPemrograman' => 'required|decimal:0,4',
                'sistemDigital' => 'required|decimal:0,4',
                'matematikaInformatika' => 'required|decimal:0,4',
            ];
        } elseif ($semester == 2) {
            $rules = [
                'pancasila' => 'required|decimal:0,4',
                'pendidikanAgama' => 'required|decimal:0,4',
                'matematikaDiskrit_2' => 'required|decimal:0,4',
                'pengantarProbabilitas' => 'required|decimal:0,4',
                'kewirausahaan' => 'required|decimal:0,4',
                'tataTulisKaryaIlmiah' => 'required|decimal:0,4',
                'strukturData' => 'required|decimal:0,4',
                'sistemOperasi' => 'required|decimal:0,4',
                'organisasiArsitekturKomputer' => 'required|decimal:0,4',
            ];
        } elseif ($semester == 3) {
            $rules = [
                'interaksiManusiaKomputer' => 'required|decimal:0,4',
                'basisData' => 'required|decimal:0,4',
                'desainAnalisisAlgoritma' => 'required|decimal:0,4',
                'rekayasaPerangkatLunak' => 'required|decimal:0,4',
                'pemrogramanBerbasisObyek' => 'required|decimal:0,4',
                'komunikasiDataJaringanKomputer' => 'required|decimal:0,4',
                'teoriBahasaOtomata' => 'required|decimal:0,4',
            ];
        }

        return $request->validate($rules);
    }
}
