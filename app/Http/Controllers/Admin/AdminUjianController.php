<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jalur;
use App\Models\Mahasiswa;
use App\Models\SoalPenjaluran;
use App\Models\SoalUjianMahasiswa;
use App\Models\UjianMahasiswa;
use App\Models\UjianPenjaluran;
use Illuminate\Http\Request;

class AdminUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ujians = UjianPenjaluran::with('ujianMahasiswa.mahasiswa')->get();
        $assignedMahasiswa = UjianMahasiswa::pluck('nim');
        $mahasiswas = Mahasiswa::whereNotIn('nim', $assignedMahasiswa)->get();
        return view('admin.ujian', compact('ujians', 'mahasiswas'));
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
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'tanggalMulai' => 'required|date',
            'waktuMulai' => 'required|date_format:H:i',
            'durasiUjian' => 'required|integer|min:1',
            'mahasiswas' => 'nullable|array',
            'mahasiswas.*' => 'exists:mahasiswas,nim',
        ]);

        $ujian = UjianPenjaluran::create([
            'title' => $validated['title'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal_mulai' => $validated['tanggalMulai'],
            'waktu_mulai' => $validated['waktuMulai'],
            'durasi_ujian' => $validated['durasiUjian'],
        ]);

        if (!empty($validated['mahasiswas'])) {
            $tanggal = $validated['tanggalMulai'];
            $jam = $validated['waktuMulai'];

            foreach ($validated['mahasiswas'] as $nim) {
                $ujianMahasiswa = UjianMahasiswa::create([
                    'nim' => $nim,
                    'id_ujian' => $ujian->id,
                ]);

                $jalurs = Jalur::all();

                foreach ($jalurs as $jalur) {
                    $soals = SoalPenjaluran::where('id_jalur', $jalur->id_jalur)
                        ->inRandomOrder()
                        ->limit(5)
                        ->get();

                    foreach ($soals as $soal) {
                        SoalUjianMahasiswa::create([
                            'id_ujian_mahasiswa' => $ujianMahasiswa->id,
                            'id_soal' => $soal->id,
                            'id_jalur' => $jalur->id_jalur,
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Ujian created successfully!');
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
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'tanggalMulai' => 'required|date',
            'waktuMulai' => 'required|date_format:H:i',
            'durasiUjian' => 'required|integer|min:1',
            'mahasiswas' => 'nullable|array',
            'mahasiswas.*' => 'exists:mahasiswas,nim',
        ]);

        $ujian = UjianPenjaluran::findOrFail($id);

        $ujian->update([
            'title' => $validated['title'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal_mulai' => $validated['tanggalMulai'],
            'waktu_mulai' => $validated['waktuMulai'],
            'durasi_ujian' => $validated['durasiUjian'],
        ]);

        if (!empty($validated['mahasiswas'])) {
            $existingNims = UjianMahasiswa::where('id_ujian', $ujian->id)->pluck('nim')->toArray();
            $newMahasiswas = array_diff($validated['mahasiswas'], $existingNims);

            foreach ($newMahasiswas as $nim) {
                $ujianMahasiswa = UjianMahasiswa::create([
                    'nim' => $nim,
                    'id_ujian' => $ujian->id,
                ]);

                $jalurs = Jalur::all();

                foreach ($jalurs as $jalur) {
                    $soals = SoalPenjaluran::where('id_jalur', $jalur->id_jalur)
                        ->inRandomOrder()
                        ->limit(5)
                        ->get();

                    foreach ($soals as $soal) {
                        SoalUjianMahasiswa::create([
                            'id_ujian_mahasiswa' => $ujianMahasiswa->id,
                            'id_soal' => $soal->id,
                            'id_jalur' => $jalur->id_jalur,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Ujian updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ujian = UjianPenjaluran::findOrFail($id);

        $ujian->delete();

        return redirect()->back()->with('success', 'Ujian deleted successfully!');
    }

    public function deleteMahasiswa(string $id)
    {
        $mahasiswa = UjianMahasiswa::findOrFail($id);

        $mahasiswa->delete();

        return redirect()->back()->with('success', 'Mahasiswa participation deleted successfully!');
    }
}
