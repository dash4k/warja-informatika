<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PenjaluranSurvey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if ($mahasiswa->survey) {
            if ($request->routeIs('penjaluran.survey')) {
                return redirect()->route('penjaluran.redirect');
            }
        }

        $mahasiswa = Auth::user()->mahasiswa->load('nilai', 'portofolio');

        $allValidated = $mahasiswa->portofolio->every(fn($p) => $p->validated);

        if (!$mahasiswa->validated || !$mahasiswa->nilai->validated || !$allValidated) {
            return redirect()->route('penjaluran.unvalidated');
        }
        
        return $next($request);
    }
}
