<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PenjaluranExam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if ($mahasiswa->ujianMahasiswa->waktu_selesai) {
            return redirect()->route('penjaluran.redirect');
        }

        $mahasiswa = $mahasiswa->load('nilai', 'portofolio', 'survey', 'ujianMahasiswa');
        
        if ($mahasiswa->portofolio) {
            $allValidated = $mahasiswa->portofolio->every(fn($p) => $p->validated);
        } else {
            $allValidated = true;
        }

        if (
            !$mahasiswa->validated ||
            !$mahasiswa->nilai->validated ||
            !$allValidated ||
            !$mahasiswa->survey ||
            !$mahasiswa->ujianMahasiswa
        ) {
            return redirect()->route('penjaluran.redirect');
        }
        
        return $next($request);
    }
}
