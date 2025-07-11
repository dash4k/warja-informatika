<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nilais = Nilai::where('validated', false)->with('mahasiswa')->get();
        return view('admin.unvalidated-nilai', compact('nilais'));
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
        
        $nilai = Nilai::where('id_nilai', $id)->firstOrFail();

        if (!$nilai) {
            return redirect()->back()->with('error', 'Nilai not found');
        }

        $nilai->admin_notes = $request->input('pesan');
        $nilai->save();

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
        $nilai = Nilai::where('id_nilai', $id)->firstOrFail();

        if (!$nilai) {
            return redirect()->back()->with('error', 'Nilai not found');
        }

        $nilai->admin_notes = null;
        $nilai->validated = true;
        $nilai->validated_at = now();
        $nilai->id_admin = Auth::user()->id_user;
        $nilai->save();

        return redirect()->back()->with('success', 'Nilai validated successfully');
    }
}
