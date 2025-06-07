<?php

namespace App\Http\Controllers\Model;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portofolios = Portofolio::where('nim', Auth::user()->mahasiswa->nim)->get();
        return view('main.portofolio', compact('portofolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaKegiatan' => 'required|string',
            'bobot' => 'required|in:1,3,5,8,10',
            'tanggalMulai' => 'required|date',
            'tanggalBerakhir' => 'required|date',
            'tempatKegiatan' => 'required|string',
            'bukti' => 'required|file|mimes:pdf',
        ]);

        $filePath = $request->file('bukti')->store('bukti_sertifikat_mahasiswa', 'public');
        
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $progression = $mahasiswa->progress;

        $portofolio = Portofolio::create([
            'nim' => $mahasiswa->nim,
            'nama_kegiatan' => $request->input('namaKegiatan'),
            'bobot' => $request->input('bobot'),
            'tanggal_mulai' => $request->input('tanggalMulai'),
            'tanggal_berakhir' => $request->input('tanggalBerakhir'),
            'tempat_kegiatan' => $request->input('tempatKegiatan'),
            'bukti' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Portofolio saved successfully.');
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
        $request->validate([
            'namaKegiatan' => 'required|string',
            'bobot' => 'required|in:1,3,5,8,10',
            'tanggalMulai' => 'required|date',
            'tanggalBerakhir' => 'required|date',
            'tempatKegiatan' => 'required|string',
        ]);

        $portofolio = Portofolio::where('id_portofolio', $id)->first();

        if ($portofolio) {
            if ($request->hasFile('bukti')) {
                $request->validate([
                    'bobot' => 'file|mimes:pdf'
                ]);

                $filePath = $request->file('bukti')->store('bukti_sertifikat_mahasiswa', 'public');
                $portofolio->update(['bukti' => $filePath]);
            }

            $portofolio->update([
                'nama_kegiatan' => $request->input('namaKegiatan'),
                'bobot' => $request->input('bobot'),
                'tanggal_mulai' => $request->input('tanggalMulai'),
                'tanggal_berakhir' => $request->input('tanggalBerakhir'),
                'tempat_kegiatan' => $request->input('tempatKegiatan'),
            ]);

            return redirect()->back()->with('success', 'Portofolio updated successfully.');
        }

        return redirect()->back()->with('error', 'Portofolio not found.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
