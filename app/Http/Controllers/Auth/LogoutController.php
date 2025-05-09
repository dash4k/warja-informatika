<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    // Logout method
    public function logout()
    {
        Auth::logout();

        // Redirect logged out users to landing page
        return redirect(route('/'));
    }
}
