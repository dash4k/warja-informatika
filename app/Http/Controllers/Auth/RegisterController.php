<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    // View method
    public function index()
    {
        return view('auth.register');
    }

    // Register method
    public function register(Request $request)
    {
        // Server side validation
        $request->validate([
            'id_user' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);

        // Create user db
        User::create([
            'id_user' => $request->id_user,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Attempt login
        Auth::attempt($request->only('email', 'password'));

        // Redirect user to login
        return redirect()->route('dashboard');
    }
}
