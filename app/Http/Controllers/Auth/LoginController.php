<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{    
    // View method
    public function index()
    {
        return view('auth.login');
    }

    // Login method
    public function login(Request $request)
    {

        // Server side validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Return error validation message
        if ($validator->fails()) 
        {
            return back()->withErrors($validator)->withInput();
        }

        // Authentication process
        if (!Auth::attempt($request->only('email', 'password'), $request->remember))
        {
            return back()->with('error', 'Invalid login details!');
        }

        // Redirect logged in users to dashboard
        return redirect()->route('dashboard');
    }
}
