<?php

namespace App\Http\Controllers\Model;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::user()->id_user;
        $mahasiswa = Mahasiswa::find($userId);
        return view('main.biodata', compact('mahasiswa'));
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
            'namaLengkap' => 'required|string',
            'kelas' => 'required|in:a,b,c,d,e,f',
            'profilePicture' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $userId = Auth::user()->id_user;

        $imagePath = $request->file('profilePicture')->store('profile_pictures', 'public');

        Mahasiswa::create([
            'nim' => $userId,
            'nama' => $request->input('namaLengkap'),
            'kelas' => $request->input('kelas'),
            'profile_picture' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Biodata saved successfully.');

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
    public function update(Request $request)
    {
        $request->validate([
            'namaLengkap' => 'required|string',
            'kelas' => 'required|in:a,b,c,d,e,f',
        ]);

        $userId = Auth::user()->id_user;

        // Find mahasiswa by nim instead of primary key
        $mahasiswa = Mahasiswa::where('nim', $userId)->first();

        if ($mahasiswa) {
            // Update profile picture only if a new file is uploaded
            if ($request->hasFile('profilePicture')) {
                $request->validate([
                    'profilePicture' => 'image|mimes:jpeg,png,jpg',
                ]);

                $imagePath = $request->file('profilePicture')->store('profile_pictures', 'public');
                $mahasiswa->update(['profile_picture' => $imagePath]);
            }

            // Update the rest of the fields
            $mahasiswa->update([
                'nama' => $request->input('namaLengkap'),
                'kelas' => $request->input('kelas'),
            ]);

            return redirect()->back()->with('success', 'Biodata updated successfully.');
        }

        return redirect()->back()->with('error', 'Mahasiswa not found.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
