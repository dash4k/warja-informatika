<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\Portofolio;
use Illuminate\Http\Request;

class AdminValidated extends Controller
{
    public function biodata()
    {
        $biodatas = Mahasiswa::where('validated', true)->paginate(5);
        return view('admin.validated-biodata', compact('biodatas'));
    }
    
    public function nilai()
    {
        $nilais = Nilai::where('validated', true)->with('mahasiswa')->paginate(10);
        return view('admin.validated-nilai', compact('nilais'));
    }
    public function portofolio()
    {
        $mahasiswas = Mahasiswa::with(['portofolio' => function ($query) {
            $query->where('validated', true);
        }])->whereHas('portofolio', function ($query) {
            $query->where('validated', true);
        })->paginate(10);
        return view('admin.validated-portofolio', compact('mahasiswas'));
    }
}
