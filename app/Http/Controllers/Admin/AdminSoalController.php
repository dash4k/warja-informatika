<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SoalPenjaluran;
use Illuminate\Http\Request;

class AdminSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $soals = SoalPenjaluran::get();

        $jumlahPerJalur = SoalPenjaluran::selectRaw('id_jalur, COUNT(*) as jumlah')
            ->groupBy('id_jalur')
            ->pluck('jumlah', 'id_jalur');

        $soalsPerJalur = $soals->groupBy('id_jalur')->map->values();

        return view('admin.soal', compact('soals', 'jumlahPerJalur', 'soalsPerJalur'));
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
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'jalur' => 'required|in:J1,J2,J3,J4,J5,J6,J7,J8,J9',
            'a' => 'required|string',
            'b' => 'required|string',
            'c' => 'required|string',
            'd' => 'required|string',
            'jawaban' => 'required|in:A,B,C,D',
        ]);

        SoalPenjaluran::create([
            'id_jalur' => $validated['jalur'],
            'pertanyaan' => $validated['pertanyaan'],
            'pilihan' => [
                'A' => $validated['a'],
                'B' => $validated['b'],
                'C' => $validated['c'],
                'D' => $validated['d'],
            ],
            'jawaban' => $validated['jawaban'], 
        ]);

        return redirect()->back()->with('success', 'Soal saved successfully.');
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
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'jalur' => 'required|in:J1,J2,J3,J4,J5,J6,J7,J8,J9',
            'a' => 'required|string',
            'b' => 'required|string',
            'c' => 'required|string',
            'd' => 'required|string',
            'jawaban' => 'required|in:A,B,C,D',
        ]);

        $soal = SoalPenjaluran::findOrFail($id);

        $soal->update([
            'id_jalur' => $validated['jalur'],
            'pertanyaan' => $validated['pertanyaan'],
            'pilihan' => [
                'A' => $validated['a'],
                'B' => $validated['b'],
                'C' => $validated['c'],
                'D' => $validated['d'],
            ],
            'jawaban' => $validated['jawaban'], 
        ]);

        return redirect()->back()->with('success', 'Soal updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $soal = SoalPenjaluran::findOrFail($id);

        $soal->delete();

        return redirect()->back()->with('success', 'Soal deleted successfully!');
    }
}
