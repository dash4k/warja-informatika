<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProgressMahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user->isMahasiswa()) {
            abort(401, 'Unauthorized Access');
        }

        $mahasiswa = $user->mahasiswa;

        $progression = $mahasiswa->progress ?? null;

        if ($progression === null) {
            abort(401, 'Unauthorized Access');
        }

        $currentStep = $progression->progress_umum;

        $stepMap = [
            'nilai' => 1,
            'berkas' => 1,
            'penjaluran' => 2,
        ];

        
        $targetStep = $this->getRequestedStep($request, $stepMap);

        if ($targetStep > $currentStep)
        {
            abort(401, 'Unauthorized Access.');
        }

        return $next($request);
    }

    private function getRequestedStep(Request $request, array $stepMap)
    {
        $routeName = $request->route()->getName();

        return $stepMap[$routeName] ?? null;
    }
}
