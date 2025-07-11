<?php

namespace App\Http\Controllers\Model;

use App\Http\Controllers\Controller;
use App\Models\SurveyJalur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'jalur' => 'required|in:J1,J2,J3,J4,J5,J6,J7,J8,J9',
        ]);

        $mahasiswaId = Auth::user()->id_user;

        SurveyJalur::create([
            'nim' => $mahasiswaId,
            'id_jalur' => $validated['jalur'],
        ]);

        return redirect()->back()->with('success', 'Survey saved successfully!');
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
