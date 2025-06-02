<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProgressNilai
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

        $currentStep = $progression->progress_nilai;

        $stepMap = [
            'semester1' => 1,
            'semester2' => 2,
            'semester3' => 3,
            'transkrip' => 4,
            'nilai.index' => 5,
        ];

        $targetStep = $this->getRequestedStep($request, $stepMap);

        if ($targetStep === null)
        {
            return $next($request);
        }

        if ($targetStep < $currentStep)
        {
            abort(401, 'Cannot go back to a previous form.');
        }

        if ($targetStep > $currentStep)
        {
            return $this->redirectToCurrentStep($currentStep);
        }

        return $next($request);
    }

    private function getRequestedStep(Request $request, array $stepMap)
    {
        $routeName = $request->route()->getName();

        if ($routeName === 'nilai')
        {
            $semester = $request->route('semester');
            return $stepMap['semester' . $semester] ?? null;
        }

        return $stepMap[$routeName] ?? null;
    }

    private function redirectToCurrentStep($currentStep)
    {
        switch ($currentStep) {
            case 1:
                return redirect('/nilai/semester1');
            case 2:
                return redirect('/nilai/semester2');
            case 3:
                return redirect('/nilai/semester3');
            case 4:
                return redirect()->route('transkrip');
            case 5:
                return redirect()->route('nilai.index');
            default:
                return redirect('/'); // fallback
        }
    }
}
