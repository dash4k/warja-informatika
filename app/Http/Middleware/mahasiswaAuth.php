<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class mahasiswaAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $mahasiswa = Auth::user();

        if (!$mahasiswa) {
            return redirect()->route('login');
        }
        else {
            if ($mahasiswa->isAdmin() || $mahasiswa->isDosen()) {
                abort(401, 'Unauthorized Access');
            }
        }
        
        return $next($request);
    }
}
