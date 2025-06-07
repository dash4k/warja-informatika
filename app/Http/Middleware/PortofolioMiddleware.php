<?php

namespace App\Http\Middleware;

use App\Models\Portofolio;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PortofolioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        $portofolio = Portofolio::where('id_portofolio', $request->route('id'))->first();

        if (!$portofolio) {
            return redirect()->back()->with('error', 'Portofolio not found.');
        }

        if ($portofolio->nim !== $user->mahasiswa->nim && !$user->isAdmin()) {
            abort(401, 'Unauthorized Access');
        }
        
        return $next($request);
    }
}
