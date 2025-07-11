<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portofolios = Portofolio::where('validated', false)->with('mahasiswa')->get();
        return view('admin.unvalidated-portofolio', compact('portofolios'));
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
        
        $portofolio = Portofolio::where('id_portofolio', $id)->firstOrFail();

        if (!$portofolio) {
            return redirect()->back()->with('error', 'Portofolio not found');
        }

        $portofolio->admin_notes = $request->input('pesan');
        $portofolio->action = 'editable';
        $portofolio->save();

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
        $portofolio = Portofolio::where('id_portofolio', $id)->firstOrFail();

        if (!$portofolio) {
            return redirect()->back()->with('error', 'Portofolio not found');
        }

        $portofolio->action = 'locked';
        $portofolio->admin_notes = null;
        $portofolio->validated = true;
        $portofolio->validated_at = now();
        $portofolio->id_admin = Auth::user()->id_user;
        $portofolio->save();

        return redirect()->back()->with('success', 'Portofolio validated successfully');
    }
}
