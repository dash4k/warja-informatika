<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    // View method
    public function index()
    {
        return view('main.berkas');
    }
}
