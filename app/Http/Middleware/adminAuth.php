<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class adminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::user();

        if (!$admin) {
            return redirect()->route('login');
        }
        else {
            if (!$admin->isAdmin()) {
                abort(401, 'Unauthorized Access');
            }
        }
        
        return $next($request);
    }
}
