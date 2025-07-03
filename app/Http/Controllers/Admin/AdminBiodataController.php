<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Clock\now;

class AdminBiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biodatas = Mahasiswa::where('validated', false)->get();
        return view('admin.unvalidated-biodata', compact('biodatas'));
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
        $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);
        
        $mahasiswa = Mahasiswa::where('nim', $id)->firstOrFail();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa not found');
        }

        $mahasiswa->admin_notes = $request->input('pesan');
        $mahasiswa->save();

        return redirect()->back()->with('success', 'Pesan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function validate(string $id)
    {
        $mahasiswa = Mahasiswa::where('nim', $id)->firstOrFail();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa not found');
        }

        $mahasiswa->validated = true;
        $mahasiswa->validated_at = now();
        $mahasiswa->id_admin = Auth::user()->id_user;
        $mahasiswa->save();

        return redirect()->back()->with('success', 'Mahasiswa validated successfully');
    }
}
