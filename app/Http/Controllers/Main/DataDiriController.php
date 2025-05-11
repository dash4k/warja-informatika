<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataDiriController extends Controller
{
    // View method
    public function index()
    {
        $userId = Auth::user()->id_user;
        $mahasiswa = mahasiswa::find($userId);
        return view('main.datadiri', compact('mahasiswa'));
    }
}
