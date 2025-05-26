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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $semester)
    {
        $validated = $this->validateSemester($request, $semester);

        session(["nilai.semester{$semester}" => $validated]);

        if ($semester < 3) {
            return redirect()->route('nilai', ['semester' => $semester + 1]);
        }

        return redirect()->route('transkrip');
    }

    public function transkrip()
    {
        return view('nilai.transkrip');
    }

    public function saveNilai(Request $request)
    {
        $request->validate([
            'transkrip' => 'required|file|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('transkrip')->store('transkrip_files', 'public');

        $allData = array_merge(
            session('nilai.semester1', []),
            session('nilai.semester2', []),
            session('nilai.semester3', []),
        );

        $userId = Auth::user()->id_user;

        Nilai::create([
            'id_nilai' => $userId,
            'etika_profesi' => $allData['etikaProfesi'],
            'kewarganegaraan' => $allData['kewarganegaraan'],
            'bahasa_indonesia' => $allData['bahasaIndonesia'],
            'matematika_diskrit_1' => $allData['matematikaDiskrit1'],
            'statistika_dasar' => $allData['statistikaDasar'],
            'algoritma_pemrograman' => $allData['algoritmaPemrograman'],
            'sistem_digital' => $allData['sistemDigital'],
            'matematika_informatika' => $allData['matematikaInformatika'],
            'pancasila' => $allData['pancasila'],
            'pendidikan_agama' => $allData['pendidikanAgama'],
            'matematika_diskrit_2' => $allData['matematikaDiskrit2'],
            'pengantar_probabilitas' => $allData['pengantarProbabilitas'],
            'kewirausahaan' => $allData['kewirausahaan'],
            'tata_tulis_karya_ilmiah' => $allData['tataTulisKaryaIlmiah'],
            'struktur_data' => $allData['strukturData'],
            'sistem_operasi' => $allData['sistemOperasi'],
            'organisasi_arsitektur_komputer' => $allData['organisasiArsitekturKomputer'],
            'interaksi_manusia_komputer' => $allData['interaksiManusiaKomputer'],
            'basis_data' => $allData['basisData'],
            'desain_analisis_algoritma' => $allData['desainAnalisisAlgoritma'],
            'rekayasa_perangkat_lunak' => $allData['rekayasaPerangkatLunak'],
            'pemrograman_berbasis_obyek' => $allData['pemrogramanBerbasisObyek'],
            'komunikasi_data_jaringan_komputer' => $allData['komunikasiDataJaringanKomputer'],
            'teori_bahasa_otomata' => $allData['teoriBahasaOtomata'],
            'transkrip_sementara' => $filePath,
        ]);

        session()->forget([
            'nilai.semester1',
            'nilai.semester2',
            'nilai.semester3',
        ]);

        return redirect()->route('nilai')->with('success', 'Sukses menginput nilai');
    }

    private function validateSemester(Request $request, $semester)
    {
        $rules = [];

        if ($semester == 1) {
            $rules = [
                'etikaProfesi' => 'required|decimal:0,4',
                'kewarganegaraan' => 'required|decimal:0,4',
                'bahasaIndonesia' => 'required|decimal:0,4',
                'matematikaDiskrit1' => 'required|decimal:0,4',
                'statistikaDasar' => 'required|decimal:0,4',
                'algoritmaPemrograman' => 'required|decimal:0,4',
                'sistemDigital' => 'required|decimal:0,4',
                'matematikaInformatika' => 'required|decimal:0,4',
            ];
        } elseif ($semester == 2) {
            $rules = [
                'pancasila' => 'required|decimal:0,4',
                'pendidikanAgama' => 'required|decimal:0,4',
                'matematikaDiskrit2' => 'required|decimal:0,4',
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

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $semester)
    {
        $data = session("nilai.semester{$semester}", []);
        return view("nilai.semester{$semester}", ['data' => $data]);
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
}
