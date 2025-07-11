<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
